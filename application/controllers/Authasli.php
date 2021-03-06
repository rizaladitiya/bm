<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {
	
	function __construct(){
		parent::__construct();		
		$this->load->model('m_login');
 
	}
	
	public function index()
	{
		$this->load->view('login');
	}
        
	function login(){
		$username = $this->input->post('username');
		$password = $this->input->post('password');
		$where = array(
			'username' => $username,
			'password' => $password
			);
		$cek = $this->m_login->cek_login("user",$where)->num_rows();
		if($cek > 0){
 
			$data_session = array(
				'nama' => $username,
				'status' => "login"
				);
 
			$this->session->set_userdata($data_session);
 
			redirect(base_url("dashboard"));
 
		}else{
			$this->load->view('login');
		}
	}
 
	function logout(){
		$this->session->sess_destroy();
		redirect(base_url('auth'));
	}
}
