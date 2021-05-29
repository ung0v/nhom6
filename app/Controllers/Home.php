<?php

namespace App\Controllers;

use App\Models\AdminModel;
use App\Models\ClassesModel;
use App\Models\ClassSubjectModel;
use App\Models\MarkModel;
use App\Models\StudentModel;
use App\Models\SubjectModel;

class Home extends BaseController
{
	public function index()
	{
		session_start();
		if ($_SESSION['user']) {
			return redirect()->to(base_url() . '/home/classes');
		}
		return view('Home');
	}
	public function markByStudentID()
	{
		if (isset($_GET['maSV'])) {
			$maSV = $_GET['maSV'];
			$markModel = new MarkModel();
			$studentModel = new StudentModel();
			$subjectModel = new SubjectModel();
			$sid = $studentModel->getStudentByCode($maSV)[0]['id'];
			if ($sid !== null) {
				$mark = $markModel->getMarkByStudentID($sid);
				foreach ($mark as $key => $value) {
					$mark[$key]['studentName'] = $studentModel->getStudentById($value['studentID'])[0]['name'];
					$mark[$key]['studentCode'] = $studentModel->getStudentById($value['studentID'])[0]['studentCode'];
					$mark[$key]['subjectName'] = $subjectModel->getSubjectById($value['subID'])[0]['name'];
				}
				$data['mark'] = $mark;
				// print_r($mark);
				return view('mark', $data);
			}
			$data['error'] = 'Không tồn tại.';
			return view('getMark', $data);
		}
	}
	public function getMark()
	{
		return view('getMark');
	}
	public function classes()
	{
		$data = [];
		$classesModel = new ClassesModel();
		$classSubjectModel = new ClassSubjectModel();
		$studentModel = new StudentModel();
		$subjectModel = new SubjectModel();
		$markModel = new MarkModel();
		session_start();
		$adminID = $_SESSION['user']['id'];
		$classes = $classesModel->getByTeacherID($adminID);

		$classIDS = [];
		$subjectIDS = [];
		// foreach ($classSubject as $key => $value) {
		// 	$classIDS[$key] = $classesModel->getById($value['teacherID'])[0]['id'];
		// 	// $subjectIDS[$key] = $subjectModel->getSubjectById($value['subID'])[0]['id'];
		// }
		// $classIDS = array_unique($classIDS);
		// $subjectIDS = array_unique($subjectIDS);
		$data['classes'] = $classes;

		// $data['subjects'] = [];
		// foreach ($classIDS as $key => $value) {
		// 	$class = $classesModel->getById($value);
		// 	$data['classes'][$key] = [
		// 		'id' => $class[0]['id'],
		// 		'name' => $class[0]['name']
		// 	];
		// }
		// foreach ($subjectIDS as $key => $value) {
		// 	$subject = $subjectModel->getSubjectById($value);
		// 	$data['subjects'][$key] = [
		// 		'id' => $subject[0]['id'],
		// 		'name' => $subject[0]['name']
		// 	];
		// }
		if ($_SESSION['role'] == '1') {
			$data['classes'] = $classesModel->getAll();
			// $data['subjects'] = $subjectModel->getAll();
		}
		if (isset($_GET['classID'])) {
			$classID = $_GET['classID'];
			// $subjectID  = $_GET['subjectID'];
			$students = $studentModel->getStudentByClassID($classID);
			foreach ($students as $key => $value) {
				$students[$key]['className'] = $classesModel->getById($classID)[0]['name'];
				$students[$key]['grade'] = $markModel->getMarkByStudentIDAndSubID($value['id'], $classID)[0]['grade'];
			}
			$data['currentClass'] = $classesModel->getById($classID)[0]['name'];

			// $data['currentSubject']  = $subjectModel->getSubjectById($subjectID)[0]['name'];

			// var_dump($students);
		}
		$data['students'] = $students;
		return view('classes', $data);
	}
	public function editMark()
	{
		if ($this->request->getMethod() == 'post') {
			if (isset($_GET['studentID']) && isset($_GET['classID'])) {
				$markModel = new MarkModel();
				$studentID = $_GET['studentID'];
				$classID = $_GET['classID'];
				$grade = $this->request->getVar('grade');
				$checkMark = $markModel->getMarkByStudentIDAndSubID($studentID, $classID)[0]['id'];
				session_start();
				$username = $_SESSION['user']['username'];
				if ($checkMark > 0) {
					$data_insert = [
						'id' => $checkMark,
						'classID' => $classID,
						'studentID' => $studentID,
						'grade' => $grade,
						'modifiedBy' => $username,
						'modifiedDate' => date("Y-m-d h:i:s"),
					];
				} else {
					$data_insert = [
						'classID' => $classID,
						'studentID' => $studentID,
						'grade' => $grade,
						'modifiedBy' => $username,
						'modifiedDate' => date("Y-m-d h:i:s"),
					];
				}

				$newMark = $markModel->save($data_insert);
				if ($newMark > 0) {
					return redirect()->to(base_url() . '/home/classes');
				} else {
					echo '<script>alert("Đã xảy ra lỗi!!!");</script>';
				}
			}
		}
		return view('editMark');
	}
	public function deleteMark()
	{
		if (isset($_GET['studentID']) && isset($_GET['classID'])) {
			$markModel = new MarkModel();
			$studentID = $_GET['studentID'];
			$classID = $_GET['classID'];
			$checkMark = $markModel->getMarkByStudentIDAndSubID($studentID, $classID)[0]['id'];
			$data_insert = [
				'id' => $checkMark,
				'grade' => null,
				'modifiedDdate' => date("Y-m-d h:i:s"),
			];
			$newMark = $markModel->save($data_insert);
			if ($newMark > 0) {
				return redirect()->to(base_url() . '/home/classes');
			}
		}
	}
	public function class()
	{
		$classesModel = new ClassesModel();
		$adminModel = new AdminModel();
		$classes = $classesModel->getAll();
		foreach ($classes as $key => $value) {
			$classes[$key]['teacherName'] = $adminModel->getById($classes[$key]['teacherID'])[0]['name'];
		}
		$data['classes'] = $classes;
		return view('class', $data);
	}
	public function editClass($classID = null)
	{
		$classesModel = new ClassesModel();
		$adminModel = new AdminModel();
		$subjectModel = new SubjectModel();
		$data['class'] = [];
		$data['teachers'] = $adminModel->getAll();
		$data['subjects'] = $subjectModel->getAll();
		if (isset($_GET['classID'])) {
			$classID = $_GET['classID'];
			$class = $classesModel->getById($classID);
			$data['class'] = $class[0];
		}
		if ($this->request->getMethod() == 'post') {
			$code = $this->request->getVar('code');
			$name = $this->request->getVar('name');
			$teacher = $this->request->getVar('teacher');
			$checkClass = $classesModel->getById($classID)[0]['id'];
			if ($classID == null) {
				$data_insert = [
					'code' => $code,
					'name' => $name,
					'teacherID' => $teacher,
					'createdDate' => date("Y-m-d h:i:s"),
				];
			} else {
				$data_insert = [
					'id' => $checkClass,
					'code' => $code,
					'name' => $name,
					'teacherID' => $teacher,
					'modifiedDate' => date("Y-m-d h:i:s"),
				];
			}
			$newClass = $classesModel->save($data_insert);
			if ($newClass > 0) {
				return redirect()->to(base_url() . '/home/class');
			} else {
				echo '<script>alert("Đã xảy ra lỗi!!!");</script>';
			}
		}
		return view('editClass', $data);
	}
	public function deleteClass()
	{
		if (isset($_GET['classID'])) {
			$classesModel = new ClassesModel();
			$classID = $_GET['classID'];
			$oldMakr = $classesModel->where('id', $classID)->delete();
			if ($oldMakr > 0) {
				return redirect()->to(base_url() . '/home/class');
			}
		}
	}
	public function subject()
	{
		$subjectModel = new SubjectModel();
		$subjects = $subjectModel->getAll();
		$data['subjects'] = $subjects;
		return view('subject', $data);
	}
	public function editSubject()
	{
		$subjectModel = new SubjectModel();
		$data['subject'] = [];

		if (isset($_GET['subjectID'])) {
			$subjectID = $_GET['subjectID'];
			$subject = $subjectModel->getSubjectById($subjectID);
			$data['subject'] = $subject[0];
		}
		if ($this->request->getMethod() == 'post') {
			$name = $this->request->getVar('name');
			$checkClass = $subjectModel->getSubjectById($subjectID)[0]['id'];
			if ($subjectID == null) {
				$data_insert = [
					'name' => $name,
					'createdDate' => date("Y-m-d h:i:s"),
				];
			} else {
				$data_insert = [
					'id' => $checkClass,
					'name' => $name,
					'modifiedDate' => date("Y-m-d h:i:s"),
				];
			}
			$newSubject = $subjectModel->save($data_insert);
			if ($newSubject > 0) {
				return redirect()->to(base_url() . '/home/subject');
			} else {
				echo '<script>alert("Đã xảy ra lỗi!!!");</script>';
			}
		}
		return view('editSubject', $data);
	}
	public function deleteSubject()
	{
		if (isset($_GET['subjectID'])) {
			$subjectModel = new SubjectModel();
			$subjectID = $_GET['subjectID'];
			$oldSubject = $subjectModel->where('id', $subjectID)->delete();
			if ($oldSubject > 0) {
				return redirect()->to(base_url() . '/home/subject');
			}
		}
	}
	public function teacher()
	{
		$adminModel = new AdminModel();
		$subjectModel = new SubjectModel();
		$teachers = $adminModel->getAll();
		foreach ($teachers as $key => $value) {
			$subIDS = unserialize($value['subID']);
			$teachers[$key]['subjectsName'] = "";
			if (is_array($subIDS)) {
				foreach ($subIDS as $index => $subID) {
					if ($index > 0) {
						$teachers[$key]['subjectsName'] = $teachers[$key]['subjectsName'] . ", " . $subjectModel->getSubjectById($subID)[0]['name'];
					} else {
						$teachers[$key]['subjectsName'] = $teachers[$key]['subjectsName'] . $subjectModel->getSubjectById($subID)[0]['name'];
					}
				}
			}
		}

		$data['teachers'] = $teachers;
		return view('teacher', $data);
	}
	public function editTeacher()
	{
		$teacherID = null;
		$adminModel = new AdminModel();
		$subjectModel = new SubjectModel();
		$data['subjects'] = $subjectModel->getAll();
		$data['teacher'] = [];
		if (isset($_GET['id'])) {
			$teacherID = $_GET['id'];
			$teacher = $adminModel->getById($teacherID);
			$teacher[0]['subIDS'] = unserialize($teacher[0]['subID']);
			$data['teacher'] = $teacher[0];
		}

		if ($this->request->getMethod() == 'post') {
			$fullname = $this->request->getVar('fullname');
			$username = $this->request->getVar('username');
			$password = $this->request->getVar('password');
			$rePassword = $this->request->getVar('rePassword');
			$gender = $this->request->getVar('gender');
			$email = $this->request->getVar('email');
			$subjects = $this->request->getVar('subjects');
			$birthday = $this->request->getVar('birthday');
			$phonenumber = $this->request->getVar('phonenumber');
			$address = $this->request->getVar('address');


			$data['error'] = [];
			$checkUsername = $adminModel->where('username', $username)->countAllResults();
			$checkEmail = $adminModel->where('email', $email)->countAllResults();
			$checkPassword = $password != $rePassword;
			$txtError = '';

			$checkTeacher = null;
			if (isset($_GET['id'])) {
				$teacherID = $_GET['id'];
				$conditionUsername = [
					'username' => $username,
					'id!=' => $teacherID
				];
				$conditionEmail = [
					'email' => $email,
					'id!=' => $teacherID
				];
				$checkUsername = $adminModel->where($conditionUsername)->countAllResults();
				$checkEmail = $adminModel->where($conditionEmail)->countAllResults();
				$checkTeacher = $adminModel->getById($teacherID)[0]['id'];
				$data_insert = [
					'id' => $checkTeacher,
					'name' => $fullname,
					'username' => $username,
					'gender' => $gender,
					'birthday' => $birthday,
					'phoneNumber' => $phonenumber,
					'email' => $email,
					'address' => $address,
					'password' => $password,
					'subID' => serialize($subjects),
					'modifiedDate' => date("Y-m-d h:i:s"),
					'status' => 1,
					'role' => 0
				];
			} else {
				$data_insert = [
					'name' => $fullname,
					'username' => $username,
					'gender' => $gender,
					'birthday' => $birthday,
					'phoneNumber' => $phonenumber,
					'email' => $email,
					'address' => $address,
					'password' => $password,
					'subID' => serialize($subjects),
					'createdDate' => date("Y-m-d h:i:s"),
					'status' => 1,
					'role' => 0
				];
			}
			if ($checkPassword || $checkUsername || $checkEmail) {
				$data['message'] = 'fail';
				if ($checkPassword) {
					$txtError = '2 mật khẩu không trùng khớp !';
					array_push($data['error'], $txtError);
				}
				if ($checkUsername != 0) {
					$txtError = 'Đã có người đăng ký username này, vui lòng nhập tên username khác !';
					array_push($data['error'], $txtError);
				}
				if ($checkEmail != 0) {
					$txtError = 'Đã có người đăng ký email này, vui lòng nhập tên email khác !';
					array_push($data['error'], $txtError);
				}
				return view('editTeacher', $data);
			}
			$newClass = $adminModel->save($data_insert);
			if ($newClass > 0) {
				return redirect()->to(base_url() . '/home/teacher');
			} else {
				echo '<script>alert("Đã xảy ra lỗi!!!");</script>';
			}
		}
		return view('editTeacher', $data);
	}
	public function deleteTeacher()
	{
		if (isset($_GET['id'])) {
			$adminModel = new AdminModel();
			$teacherID = $_GET['id'];
			$old = $adminModel->where('id', $teacherID)->delete();
			if ($old > 0) {
				return redirect()->to(base_url() . '/home/teacher');
			}
		}
	}
	public function classSubject()
	{
		$data = [];
		$classSubjectModel = new ClassSubjectModel();
		$classesModel = new ClassesModel();
		$subjectModel = new SubjectModel();
		$adminModel = new AdminModel();

		$classSubject = $classSubjectModel->getAll();
		$result = [];
		foreach ($classSubject as $key => $value) {
			$result[$key]['id'] = $value['id'];
			$result[$key]['class']['className'] = $classesModel->getById($value['classID'])[0]['name'];
			$result[$key]['class']['classID'] = $value['classID'];
			$result[$key]['subject']['subjectName'] = $subjectModel->getSubjectById($value['subID'])[0]['name'];
			$result[$key]['subject']['subjectID'] = $value['subID'];
			$result[$key]['teacher']['teacherName'] = $adminModel->getById($value['adminID'])[0]['name'];
			$result[$key]['teacher']['teacherID'] = $value['adminID'];
		}
		$data['result'] = $result;
		// var_dump($result);
		return view('classSubject', $data);
	}
	public function editClassSubject()
	{
		$classSubjectModel = new ClassSubjectModel();
		$classesModel = new ClassesModel();
		$subjectModel = new SubjectModel();
		$adminModel = new AdminModel();
		$data['classSubjects'] = [];
		$classes = $classesModel->getAll();
		$subjects = $subjectModel->getAll();
		$teachers = $adminModel->getAll();
		$data['classes'] = $classes;
		$data['subjects'] = $subjects;
		$data['teachers'] = $teachers;
		if (isset($_GET['id'])) {
			$id = $_GET['id'];
			$classSubject = $classSubjectModel->getById($id);
			$classID = $classSubject[0]['classID'];
			$subjectID = $classSubject[0]['subID'];
			$teacherID = $classSubject[0]['adminID'];
			$class = $classesModel->getById($classID);
			$subject = $subjectModel->getSubjectById($subjectID);
			$teacher = $adminModel->getById($teacherID);


			$data['classID'] = $classID;
			$data['subjectID'] = $subjectID;
			$data['teacherID'] = $teacherID;

			$data['class'] = $class[0];
			$data['subject'] = $subject[0];
			$data['teacher'] = $teacher[0];
		}
		if ($this->request->getMethod() == 'post') {
			$teacher = $this->request->getVar('teacher');
			$class = $this->request->getVar('class');
			$subject = $this->request->getVar('subject');
			$classSubjects = $classSubjectModel->getAll();
			foreach ($classSubjects as $item) {
				if ($item['adminID'] == $teacher && $item['subID'] == $subject && $item['classID'] == $class) {
					$data['error'] = 'Đã tồn tại bộ môn này';
					return view('editClassSubject', $data);
				}
			}
			if (isset($_GET['id'])) {
				$id = $_GET['id'];
				$data_insert = [
					'id' => $id,
					'adminID' => $teacher,
					'subID' => $subject,
					'classID' => $class,
				];
			} else {
				$data_insert = [
					'adminID' => $teacher,
					'subID' => $subject,
					'classID' => $class,
				];
			}
			$new = $classSubjectModel->save($data_insert);
			if ($new > 0) {
				return redirect()->to(base_url() . '/home/classSubject');
			} else {
				echo '<script>alert("Đã xảy ra lỗi!!!");</script>';
			}
		}
		return view('editClassSubject', $data);
	}
	public function deleteClassSubject()
	{
		if (isset($_GET['id'])) {
			$classSubjectModel = new ClassSubjectModel();
			$id = $_GET['id'];
			$old = $classSubjectModel->where('id', $id)->delete();
			if ($old > 0) {
				return redirect()->to(base_url() . '/home/classSubject');
			}
		}
	}
	public function students()
	{
		$studentModel = new StudentModel();
		$students = $studentModel->getAll();
		$data['students'] = $students;

		return view('student', $data);
	}
	public function editStudent()
	{
		$studentModel = new StudentModel();
		$classesModel = new ClassesModel();
		$classes = $classesModel->getAll();
		$data['classes'] = $classes;
		$data['student'] = [];
		if (isset($_GET['id'])) {
			$studentID = $_GET['id'];
			$student = $studentModel->getStudentById($studentID);
			$data['student'] = $student[0];
		}

		if ($this->request->getMethod() == 'post') {
			$fullname = $this->request->getVar('fullname');
			$username = $this->request->getVar('username');
			$classID = $this->request->getVar('classID');
			$studentCode = $this->request->getVar('studentCode');
			$password = $this->request->getVar('password');
			$rePassword = $this->request->getVar('rePassword');
			$gender = $this->request->getVar('gender');
			$email = $this->request->getVar('email');
			$birthday = $this->request->getVar('birthday');
			$phonenumber = $this->request->getVar('phonenumber');
			$address = $this->request->getVar('address');


			$data['error'] = [];
			$checkUsername = $studentModel->where('username', $username)->countAllResults();
			$checkEmail = $studentModel->where('email', $email)->countAllResults();
			$checkPassword = $password != $rePassword;
			$txtError = '';


			$checkStudent = null;
			if (isset($_GET['id'])) {
				$studentID = $_GET['id'];
				$conditionUsername = [
					'username' => $username,
					'id!=' => $studentID
				];
				$conditionEmail = [
					'email' => $email,
					'id!=' => $studentID
				];
				$checkUsername = $studentModel->where($conditionUsername)->countAllResults();
				$checkEmail = $studentModel->where($conditionEmail)->countAllResults();
				$checkStudent = $studentModel->getStudentById($studentID)[0]['id'];
				$data_insert = [
					'id' => $checkStudent,
					'name' => $fullname,
					'classID' => $classID,
					'studentCode' => $studentCode,
					'username' => $username,
					'gender' => $gender,
					'birthday' => $birthday,
					'phoneNumber' => $phonenumber,
					'email' => $email,
					'address' => $address,
					'password' => $password,
					'modifiedDate' => date("Y-m-d h:i:s"),
					'status' => 1,
				];
			} else {
				$data_insert = [
					'name' => $fullname,
					'classID' => $classID,
					'studentCode' => $studentCode,
					'username' => $username,
					'gender' => $gender,
					'birthday' => $birthday,
					'phoneNumber' => $phonenumber,
					'email' => $email,
					'address' => $address,
					'password' => $password,
					'createdDate' => date("Y-m-d h:i:s"),
					'status' => 1,
				];
			}
			$count = $studentModel->coutStudentbyClassID($classID);
			$class = $classesModel->getById($classID);
			if ($count >= $class[0]['numberStudent']) {
				$full = true;
			}
			if ($checkPassword || $checkUsername || $checkEmail || $full) {
				$data['message'] = 'fail';
				if ($checkPassword) {
					$txtError = '2 mật khẩu không trùng khớp !';
					array_push($data['error'], $txtError);
				}
				if ($checkUsername != 0) {
					$txtError = 'Đã có người đăng ký username này, vui lòng nhập tên username khác !';
					array_push($data['error'], $txtError);
				}
				if ($checkEmail != 0) {
					$txtError = 'Đã có người đăng ký email này, vui lòng nhập tên email khác !';
					array_push($data['error'], $txtError);
				}
				if ($full) {
					$txtError = 'Lớp đã đầy!!!';
					array_push($data['error'], $txtError);
				}
				return view('editStudent', $data);
			}
			var_dump($data_insert);
			$newClass = $studentModel->save($data_insert);
			if ($newClass > 0) {
				return redirect()->to(base_url() . '/home/students');
			} else {
				echo '<script>alert("Đã xảy ra lỗi!!!");</script>';
			}
		}
		var_dump($data_insert);

		return view('editStudent', $data);
	}
	public function deleteStudent()
	{
		if (isset($_GET['id'])) {
			$studentModel = new StudentModel();
			$teacherID = $_GET['id'];
			$old = $studentModel->where('id', $teacherID)->delete();
			if ($old > 0) {
				return redirect()->to(base_url() . '/home/students');
			}
		}
	}
	public function PhanQuyen()
	{
		$adminModel = new AdminModel();
		$allAdmin = $adminModel->getAllAdmin();
		$data['AllAdmin'] = $allAdmin;
		return view('PhanQuyen', $data);
	}
	public function editPhanQuyen()
	{
		if ($this->request->getMethod() == 'post') {
			$role = $this->request->getVar('role');
			var_dump(1111111111111111);

			if (isset($_GET['id'])) {
				$id = $_GET['id'];
				$adminModel = new AdminModel();
				$data_insert = [
					'id' => $id,
					'role' => $role
				];
				$new = $adminModel->save($data_insert);
				if ($new > 0) {
					return redirect()->to(base_url() . '/home/PhanQuyen');
				} else {
					echo '<script>alert("Đã xảy ra lỗi!!!");</script>';
				}
			}
		}
		return view('editPhanQuyen');
	}
}
