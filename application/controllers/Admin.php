<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {
	public function index(){
		$this->_make_sure_is_admin();
		//data admin
		$data['nama_admin'] = $_SESSION['username'];
		$data['level'] = $_SESSION['level'];
		//data admin
		$this->load->view('admin/dashboard', $data);

	}
	function register(){

	}
	function _make_sure_is_admin(){
		if ($_SESSION['login_status'] != TRUE) {
			$this->session->sess_destroy();
			redirect('login','refresh');
		}
	}
	function logout(){
		$this->session->sess_destroy();
		redirect('login','refresh');

	}
}
