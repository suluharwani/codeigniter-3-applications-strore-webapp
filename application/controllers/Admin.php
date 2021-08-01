<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {
	function __construct(){
		parent::__construct();
		if(isset($_SESSION['login_status'])){
			if ($_SESSION['login_status'] != TRUE) {
				$this->session->sess_destroy();
				redirect('login','refresh');
			}
		}else{
			$this->session->sess_destroy();
			redirect('login','refresh');
		}
		
	}

	public function index(){
		$data['page'] = "Dasboard";
		$this->load->view('admin/dashboard', $data);
	}
	public function content(){
		$data['page'] = "Content";
		$this->load->view('admin/content', $data);
	}
	function data_content(){
		$this->load->model('Mdl_content', 'model_content');
		$list = $this->model_content->get_datatables();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $field) {
			$no++;
			$row = array();
			$row[] = $no;
			$row[] = $field->nama;
			$row[] = $field->slug;
			$row[] = $field->created_at;
			$row[] = $field->updated_at;

			$data[] = $row;
		}

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->model_content->count_all(),
			"recordsFiltered" => $this->model_content->count_filtered(),
			"data" => $data,
		);
        //output dalam format JSON
		echo json_encode($output);
	}
	function logout(){
		$this->session->sess_destroy();
		redirect('login','refresh');

	}
}
