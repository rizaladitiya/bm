<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Gudang extends CI_Controller {
	private $limit=20;
	function __construct(){
		parent::__construct();
		
		if($this->session->userdata('status') != "login"){
			redirect(base_url("auth"));
		}
		$this->load->library('user_agent');
		$this->load->helper(array('form','url','system_helper'));
	}
 
	function index(){
	}
	function addpp(){
		
		
		$this->load->view('gudang/addpp.php',$data);
		
	}
	function viewpp(){
	
		$this->load->view('gudang/viewpp.php',$data);
	}
	function lappp(){
	
		$master=json_decode(file_get_contents("http://".server()."/api/baranggudang/masterbagian"));
		//$master=json_decode(file_get_contents("http://192.168.1.222/api/baranggudang/masterbagian"));
		$data['bagian']=$master;
		$data['pp']=(object)array();
		$cektgl=$this->input->post('tgl');
		$cektgl2=$this->input->post('tgl2');
		$bagian=$this->input->post('bagian');
		if(isset($cektgl) or isset($cektgl2)){
			$this->load->library(array('table'));
			//$url="http://localhost/api/permintaangudang/bagian/";
			$url="http://".server()."/api/permintaangudang/bagian/";
			$param = $this->input->post('bagian');
			$param = $param."/".$this->input->post('tgl');
			if(isset($cektgl2)){
				$param = $param."/".$this->input->post('tgl2');
			}else{
				$param = $param."/".$this->input->post('tgl');
			}
			$arrs = json_decode(file_get_contents($url.$param));
			$this->table->set_empty("&nbsp;");
			$tmpl = array ('table_open'=>'<table width="100%" border="1" cellspacing="0" cellpadding="0" id="tabellaporan">');
			$this->table->set_template($tmpl); 
			$this->table->set_heading(
			'No',
			'Tgl PP',
			'PP',
			'Bagian',
			'Barang',
			'Qty PP',
			'Tgl PO',
			'PO',
			'Qty PO',
			'Tgl PB',
			'PB',
			'Qty PB'
			);
			$i=1;
				foreach ($arrs as $arr){
				$this->table->add_row(
					array('data' => $i, 'align' => 'center'),
					array('data' => date('d-M-y',strtotime($arr->datetime)), 'align' => 'center'),
					array('data' => $arr->no, 'align' => 'center'),
					array('data' => $arr->namabagian, 'align' => 'center'),
					array('data' => $arr->namabarang, 'align' => 'left'),
					array('data' => number_format($arr->jumlah), 'align' => 'right'),
					array('data' => $arr->tglpo?date('d-M-y',strtotime($arr->tglpo)):"&nbsp;", 'align' => 'right'),
					array('data' => $arr->po, 'align' => 'center'),
					array('data' => $arr->qtypo, 'align' => 'right'),
					array('data' => '', 'align' => 'right'),
					array('data' => '', 'align' => 'right'),
					array('data' => '', 'align' => 'right')
				);
				
				$i++;
				}
			
			$data['table']=$this->table->generate();
		}
		$this->load->view('gudang/lappp.php',$data);
	}
	
	
}
