<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {
	
	function __construct(){
		parent::__construct();		
 		$this->load->model('m_login','',TRUE);
	}
	
	public function index()
	{
		$this->load->view('login');
	}
        
	function login(){
		$password = $this->input->post('password');
		$post = array(
			'password' => $password
			);
		$url="http://".server()."/api/login";
		//$url="http://192.168.1.222/api/login";
		$response = json_decode(httpPost($url,$post));
		//echo httpPost($url,$post);
		if($response->id > 0){
 
			$data_session = array(
				'id' => $response->id,
				'nama' => $response->nama,
				'kelompok' => $response->kelompok,
				'bagian' => $response->bagian,
				'status' => "login"
				);
 
			$this->session->set_userdata($data_session);
 
			redirect(base_url("dashboard"));
 
		}else{
			$where = array(
			'password' => $password
			);
			$query=$this->m_login->cek_login("user",$where);
			$cek = $query->num_rows();
			$response=$query->row();
			if($cek > 0){
 
				$data_session = array(
					'id' => $response->id,
					'nama' => $response->username,
					'kelompok' => $response->kelompok,
					'bagian' => $response->bagian,
					'status' => "login"
					);
	 
				$this->session->set_userdata($data_session);
	 
				redirect(base_url("dashboard"));
 
			}else{
				$this->load->view('login');
			}
		}
	}
 
	function logout(){
		$this->session->sess_destroy();
		redirect(base_url('auth'));
	}
}
