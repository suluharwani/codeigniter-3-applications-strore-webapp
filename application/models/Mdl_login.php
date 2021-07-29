<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Mdl_login extends CI_Model{
	public function banyak_super_admin(){
		$this->db->where('level', 1);
		return $this->db->get('admin')->num_rows();
	}
	public function daftar_admin_baru($username,$password1){
		if ($this->banyak_super_admin() == 0) {
			$object = array(
				'username' => $username,
				'password'=> $this->bcrypt->hash_password($password1),
				'created_at'=>date("Y-m-d H:i:s"),
				'status'=> 1,
				'level'=>1
			);
			$this->db->insert('admin', $object);
			return $this->db->affected_rows();
		}
		
	}
	function check_attempt(){
		$ip = $this->input->ip_address();
		$date = date('Y-m-d');
		return $this->db->get_where('riwayat_login', array('ip_address'=>$ip, 'DATE(waktu)'=> $date, 'status'=>0))->num_rows();
	}
	function tambah_attempt_login_fail($username, $password){
		$object = array(
			'ip_address' => $this->input->ip_address(),
			'waktu' => date("Y-m-d H:i:s"),
			'username' => $username,
			'password'=> $this->bcrypt->hash_password($password),
			'status'=> 0
		);
		$this->db->insert('riwayat_login', $object);
		return $this->check_attempt();
	}
	function tambah_attempt_login_success($username, $password){
		$object = array(
			'ip_address' => $this->input->ip_address(),
			'waktu' => date("Y-m-d H:i:s"),
			'username' => $username,
			'password'=> $this->bcrypt->hash_password($password),
			'status'=> 1
		);
		$this->db->insert('riwayat_login', $object);
	}
	function logadmin($username, $password){
		$this->db->select('username, password, level');
		$this->db->where('username', $username);
		$data_user = $this->db->get('admin');
		if ($data_user->num_rows() == 0) {
			return false;
		}else{
			$hash = $data_user->row()->password;
			if ($this->bcrypt->check_password($password, $hash)){
				$this->db->where(array('ip_address' => $this->input->ip_address(),
					'DATE(waktu)' => date('Y-m-d'),
					'status'=>0
				)
					);
				$this->db->delete('riwayat_login');
				$this->tambah_attempt_login_success($username, $password);
				$array = array(
					'login_status' => true,
					'username' => $username,
					'level'=>$data_user->row()->level
				);
				
				$this->session->set_userdata( $array );
				return true;
			}
			else{
				return false;
			}

		}
	}


}