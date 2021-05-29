<?php

namespace App\Controllers;

use App\Models\AdminModel;
use App\Models\StudentModel;
use App\Models\SubjectModel;

class Register extends BaseController
{
	public function index()
	{
		$adminModel = new AdminModel();
		$studentModel = new StudentModel();
		$subjectModel = new SubjectModel();
		$data['subjects'] = $subjectModel->getAll();
		if ($this->request->getMethod() == 'post') {
			$fullname = $this->request->getVar('fullname');
			$username = $this->request->getVar('username');
			$password = $this->request->getVar('password');
			$rePassword = $this->request->getVar('rePassword');
			// $position = $this->request->getVar('position');
			$gender = $this->request->getVar('gender');
			$email = $this->request->getVar('email');
			$birthday = $this->request->getVar('birthday');
			$phonenumber = $this->request->getVar('phonenumber');
			$address = $this->request->getVar('address');


			$data['error'] = [];
			$checkUsername = false;
			$checkEmail = false;
			// if ($position == '0') {
			// 	$checkUsername = $adminModel->where('username', $username)->countAllResults();
			// 	$checkEmail = $adminModel->where('email', $email)->countAllResults();
			// }
			// if ($position == '1') {
			// 	$checkUsername = $studentModel->where('username', $username)->countAllResults();
			// 	$checkEmail = $studentModel->where('email', $email)->countAllResults();
			// }
			$checkUsername = $adminModel->where('username', $username)->countAllResults();
			$checkEmail = $adminModel->where('email', $email)->countAllResults();
			$checkPassword = $password != $rePassword;
			$txtError = '';
			if ($checkPassword || $checkUsername) {
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
				return view('register', $data);
			}
			$data_insert = [
				'name' => $fullname,
				'username' => $username,
				'gender' => $gender,
				'birthday' => $birthday,
				'phoneNumber' => $phonenumber,
				'email' => $email,
				'address' => $address,
				'password' => $password,
				'createdDate' => date("Y-m-d h:i:s"),
				'status' => 1,
				'role' => 0
			];
			$newuser = $adminModel->insert($data_insert);
			if ($newuser > 0) {
				$data['message'] = 'success';
				return view('register', $data);
			} else {
				$data['message'] = 'fail';
				return view('register', $data);
			}
			// if ($position == '1') {
			// 	$newuser = $adminModel->insert($data_insert);
			// 	if ($newuser) {
			// 		$data['message'] = 'success';
			// 		return view('register', $data);
			// 	} else {
			// 		$data['message'] = 'fail';
			// 		return view('register', $data);
			// 	}
			// } elseif ($position == '1') {
			// 	$newuser = $studentModel->insert($data_insert);
			// 	if ($newuser) {
			// 		$data['message'] = 'success';
			// 		return view('register', $data);
			// 	} else {
			// 		$data['message'] = 'fail';
			// 		return view('register', $data);
			// 	}
			// }		
		}

		return view('Register', $data);
	}
}
