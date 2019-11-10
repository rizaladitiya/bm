<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Po extends CI_Controller {
	private $limit=10;
	function __construct(){
		parent::__construct();
		
		if($this->session->userdata('status') != "login"){
			redirect(base_url("auth"));
		}
		//$this->load->model('reject_model','',TRUE);
		//$this->load->helper(array('form'));
	}
 
	function tigabulan(){
		if(isset($_REQUEST['tgl'])){
			$tgl = $_REQUEST['tgl'];//$data['po']=json_decode(file_get_contents("http://".server()."/api/order/tigabulan/".$tgl));
			$data['po']=json_decode(file_get_contents("http://".server()."/api/order/tigabulan/".$tgl));
			$data['tgl']=$tgl;
		}
			$data[]='';
		$this->load->view('po/tigabulan.php',$data);
		
	}
}
