<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {
	public function index()
	{
		$this->_make_sure_is_admin();
		$this->load->view('admin/dashboard');
	}
	public function login($username,$password){
		$userModel = new \App\Models\Mdl_admin();
		$admin_data = $userModel->get_cipherpass($username);
		if ($admin_data != NULL) {
			if($this->bcrypt->verify($password, $admin_data['password'])){
				$data_login = [
					'nama' => $admin_data['nama_depan'].' '.$admin_data['nama_belakang'],
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
	function register(){

	}
	function _make_sure_is_login(){
		if (isset($_SESSION['login_data'])) {
			return TRUE;
		}else{
			return FALSE;
		}
	}
	function _make_sure_is_admin(){
		if ($this->_make_sure_is_login() != TRUE) {
			$this->session->sess_destroy();
			redirect('login','refresh');
		}
	}
	function logout(){
		$this->session->destroy();
		redirect('login','refresh');

	}
	public function check_password(){
		$pass1 = $_POST['password'];
		$pass2 = $_POST['confirm_password'];
		if (strlen($pass1)>=40){
			$hasil = 'terlalu panjang';
		}else{
			if ($pass1 == $pass2 && strlen($pass1)>=5) {
				$hasil = 'sesuai';
			}else{
				$hasil = false;
			}
		}

		if($hasil == 'sesuai'){
			echo '<label class="text-success"><span><i class="fa fa-check-circle-o" aria-hidden="true"></i> Password Sesuai</span></label>';
		}
		else if($hasil == 'terlalu panjang'){
			echo '<label class="text-danger"><span><i class="fa fa-times" aria-hidden="true">
			</i>Password terlalu panjang</span></label>';
		}
		else {
			echo '<label class="text-danger"><span><i class="fa fa-times" aria-hidden="true">
			</i>Password tidak sama atau kurang dari 5 karakter</span></label>';
		}
	}
}