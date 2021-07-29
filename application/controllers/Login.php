<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {
	function __construct() {
		parent::__construct();
		$this->load->model('Mdl_login', 'login');

	}
	public function index()
	{
		$banyak_super_admin = $this->login->Banyak_super_admin();
		if ($banyak_super_admin>0) {
			$this->load->view('login/index');
		}else{
			$this->load->view('login/register');
		}
		
		// echo('aaa');
	}
	function logadmin(){
		$this->form_validation->set_rules('username', 'Username', 'trim|required|min_length[5]|max_length[30]');
		$this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[5]|max_length[30]');
		if ($this->form_validation->run() == FALSE){
			$u = $this->input->post('username');
			$p = $this->input->post('password');
			if ($u == '') {
				$u= null;
			}
			if ($p == '') {
				$p= null;
			}
			$login_attempt_fail = $this->login->tambah_attempt_login_fail($u, $p);
			if ($login_attempt_fail>=20) {
				header('HTTP/1.1 500 Internal Server Error');
				header('Content-Type: application/json; charset=UTF-8');
				die(json_encode(array(
					'status' => 'gagal',
					'message'=> 'Percobaan login telah gagal sebanyak 20x tunggu sampai hari selanjutnya untuk masuk melalui perangkat ini!'
				)));
			}else{
				header('HTTP/1.1 500 Internal Server Error');
				header('Content-Type: application/json; charset=UTF-8');
				echo json_encode(array("message" => "LOGIN GAGAL ".$login_attempt_fail." X, \n PERIKSA USERNAME & PASSWORD", "code" => 2));
			}
		}
		else{
			$username = $this->input->post('username');
			$password = $this->input->post('password');
			if ($this->login->check_attempt() >=20) {
				header('HTTP/1.1 500 Internal Server Error');
				header('Content-Type: application/json; charset=UTF-8');
				die(json_encode(array(
					'status' => 'gagal',
					'message'=> 'Percobaan login telah gagal sebanyak 20x tunggu sampai hari selanjutnya untuk masuk melalui perangkat ini!'
				)));
			}else{
				if ($this->login->logadmin($username, $password) == false) {
					$login_attempt_fail = $this->login->tambah_attempt_login_fail($username, $password);
					header('HTTP/1.1 500 Internal Server Error');
					header('Content-Type: application/json; charset=UTF-8');
					echo json_encode(array("message" => "LOGIN GAGAL ".$login_attempt_fail." X, \n PERIKSA USERNAME & PASSWORD", "code" => 2));
				}else{
					echo json_encode(array("message" => "sukses", "code" => 2));
				}
			}
		}


	}
	function daftar_admin(){
		$this->form_validation->set_rules('username', 'Username', 'trim|required|min_length[5]|max_length[30]|is_unique[admin.username]');
		$this->form_validation->set_rules('password1', 'Password1', 'trim|required|min_length[5]|max_length[30]');
		$this->form_validation->set_rules('password2', 'Password2', 'trim|required|min_length[5]|max_length[30]');
		
		if ($this->form_validation->run() == FALSE)
		{
			header('HTTP/1.1 500 Internal Server Error');
			header('Content-Type: application/json; charset=UTF-8');
			die(json_encode(array('message' => 'ERROR VALIDATION', 'code' => 1337)));
		}
		else
		{
			$username = $this->input->post('username');
			$password1 = $this->input->post('password1');
			$password2 = $this->input->post('password2');
			$daftar_status = '';
			if ($password1 === $password2) {
				$daftar_status = $this->login->daftar_admin_baru($username,$password1);
				if ($daftar_status>0) {
					echo json_encode(array(
						'status' => 'success',
						'message'=> 'Berhasil Registrasi!'
					));
				}else{
					header('HTTP/1.1 500 Internal Server Error');
					header('Content-Type: application/json; charset=UTF-8');
					die(json_encode(array('message' => 'ERROR VALIDATION', 'code' => 1337)));
				}
				
			}else{
				header('HTTP/1.1 500 Internal Server Error');
				header('Content-Type: application/json; charset=UTF-8');
				die(json_encode(array('message' => 'ERROR VALIDATION', 'code' => 1337)));
			}

		}
	}
	function check_confirm_password(){
		$password = $this->input->post('password');
		$repeatpassword = $this->input->post('repeatpassword');
		if (strlen($password) >= 5) {
			if ($repeatpassword === $password) {
				echo '<label class="text-success"><span><i class="fa fa-check" aria-hidden="true">
				</i> password sesuai</span></label>';
			}else{
				echo '<label class="text-danger"><span><i class="fa fa-times" aria-hidden="true">
				</i> password tidak sesuai</span></label>';
			}
		}
	}
	function check_password(){
		$password = $this->input->post('password');
		if (strlen($password) < 5) {
			echo '<label class="text-danger"><span><i class="fa fa-times" aria-hidden="true">
			</i> password kurang dari 5 karakter</span></label>';
		}
	}
	function check_username(){
		$username = $this->input->post('username');
		if (strlen($username) < 5) {
			echo '<label class="text-danger"><span><i class="fa fa-times" aria-hidden="true">
			</i> Username kurang dari 5 karakter</span></label>';
		}else if(strlen($username) > 30){
			echo '<label class="text-danger"><span><i class="fa fa-times" aria-hidden="true">
			</i> Username terlalu panjang</span></label>';
		}else{
			echo '<label class="text-success"><span><i class="fa fa-check" aria-hidden="true">
			</i> Username dapat dipakai</span></label>';
		}
		
	}
	function check_username_exist(){
		$username = $this->input->post('username');

	}
	public function login_verify($username,$password){

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
