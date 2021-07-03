<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {
	public function index()
	{
		$this->load->view('login/index');
	}
	public function login($username,$password){
		$userModel = $this->load->model('Mdl_login');
		$admin_data = $userModel->get_cipherpass($username);
		if ($admin_data != NULL) {
			if($this->bcrypt->verify($password, $admin_data['password'])){
				$data_login = [
					'user' => $admin_data['username'],
					'level' => $admin_data['level'],
					'status'=> TRUE
				];
				$this->session->set('login_data', $data_login);
			}else{
				$this->session->setFlashData("gagal", "Login Failed!");
			}
		}else {
			$this->session->setFlashData("gagal", "Login Failed!");
		}
	}

}
