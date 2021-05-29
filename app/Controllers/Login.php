<?php

namespace App\Controllers;

use App\Models\AdminModel;
use App\Models\StudentModel;
use SendEmail;

class Login extends BaseController
{
	public function index()
	{
		session_start();
		if ($_SESSION['user']) {
			return redirect()->to(base_url() . '/home/classes');
		}
		if ($this->request->getMethod() == 'post') {
			$adminModel = new AdminModel();
			$username = $this->request->getVar('username');
			$password = $this->request->getvar('password');

			$data = [
				'username' => $username,
				'password' => $password
			];

			$user = $adminModel->where($data)->first();
			if ($user) {
				// $sendEmail = new SendEmail();
				// $sendEmail->send($user['email']);
				$_SESSION['user'] = $user;
				$_SESSION['role'] = $user['role'];
				return redirect()->to('home');
			}
		}
		return view('Login');
	}
	public function logout()
	{
		session_start();
		session_destroy();
		return redirect()->to(base_url() . "/");
	}
}
