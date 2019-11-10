<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Costcontrol extends CI_Controller {
	private $limit=20;
	function __construct(){
		parent::__construct();
		
		if($this->session->userdata('status') != "login"){
			redirect(base_url("auth"));
		}
		$this->load->library(array('table','form_validation','user_agent'));
		$this->load->helper(array('form'));
	}
 
	function hargadetail(){
		$berat=0;
		$total=0;
		$data['action']= site_url('costcontrol/hargadetail');
		$data['title']='Harga Plan Detail'.cekserver();
		$data['method']=array('method'=>'get');
		$i=1;
		$cektgl=$this->input->get('tgl');
		$cektgl2=$this->input->get('tgl2');
		if(isset($cektgl) or isset($cektgl2)){
			$url="http://".server()."/api/order/hargaplandetail/";	
			$param = $this->input->get('tgl');
			if(isset($cektgl2)){
				$param = $param."/".$this->input->get('tgl2');
			}else{
				$param = $param."/".$this->input->get('tgl');
			}
			$arrs = json_decode(file_get_contents($url.$param));
			$this->table->set_empty("&nbsp;");
			$tmpl = array ('table_open'=>'<table width="100%" border="1" cellspacing="0" cellpadding="0" id="tabellaporan">');
			$this->table->set_template($tmpl); 
			$this->table->set_heading(
		'No',
		'Tanggal',
		'PM',
		'Prior.',
		'Customer',
		'Barang',
		'Harga',
		'Berat',
		'Total'
		);
		foreach ($arrs as $arr){
		$this->table->add_row(
			array('data' => $i, 'align' => 'center'),
			array('data' => date('d-M-y',strtotime($arr->tanggal)), 'align' => 'center'),
			array('data' => $arr->pm, 'align' => 'center'),
			array('data' => $arr->prioritas, 'align' => 'center'),
			array('data' => $arr->customer_nama, 'align' => 'left'),
			array('data' => $arr->barang, 'align' => 'left'),
			array('data' => number_format($arr->harga), 'align' => 'right'),
			array('data' => number_format($arr->jumlah), 'align' => 'right'),
			array('data' => number_format($arr->jumlah*$arr->harga), 'align' => 'right')
		);
		$berat = $berat+$arr->jumlah;
		$total = $total+($arr->jumlah*$arr->harga);
		$i++;
		}
		$this->table->add_row(
			array('data' => '&nbsp;', 'align' => 'center'),
			array('data' => '&nbsp;', 'align' => 'center'),
			array('data' => '&nbsp;', 'align' => 'center'),
			array('data' => '&nbsp;', 'align' => 'center'),
			array('data' => '&nbsp;', 'align' => 'center'),
			array('data' => 'Total', 'align' => 'center'),
			array('data' => number_format($berat), 'align' => 'right'),
			array('data' => number_format($total), 'align' => 'right')
		);
		$data['table']=$this->table->generate();
		
		}
		$this->load->view('costcontrol/hargadetail',$data);
	
	}
	function hargajenis(){
		$berat=0;
		$total=0;
		$data['action']= site_url('costcontrol/hargajenis');
		$data['title']='Harga Plan Jenis'.cekserver();
		$data['method']=array('method'=>'get');
		$i=1;
		$cektgl=$this->input->get('tgl');
		$cektgl2=$this->input->get('tgl2');
		if(isset($cektgl) or isset($cektgl2)){
			$url="http://".server()."/api/order/hargaplanjenis/";	
			$param = $this->input->get('tgl');
			if(isset($cektgl2)){
				$param = $param."/".$this->input->get('tgl2');
			}else{
				$param = $param."/".$this->input->get('tgl');
			}
			$arrs = json_decode(file_get_contents($url.$param));
			$this->table->set_empty("&nbsp;");
			$tmpl = array ('table_open'=>'<table width="100%" border="1" cellspacing="0" cellpadding="0" id="tabellaporan">');
			$this->table->set_template($tmpl); 
			$this->table->set_heading(
		'No',
		'PM',
		'Jenis',
		'Jumlah',
		'Rata2',
		'Total'
		);
		foreach ($arrs as $arr){
		$this->table->add_row(
			array('data' => $i, 'align' => 'center'),
			array('data' => $arr->pm, 'align' => 'center'),
			array('data' => $arr->nama." ".$arr->gsm, 'align' => 'center'),
			array('data' => number_format($arr->jumlah), 'align' => 'right'),
			array('data' => number_format($arr->rata), 'align' => 'right'),
			array('data' => number_format($arr->total), 'align' => 'right')
		);
		$berat = $berat+$arr->jumlah;
		$total = $total+($arr->jumlah*$arr->rata);
		$i++;
		}
		$this->table->add_row(
			array('data' => '&nbsp;', 'align' => 'center'),
			array('data' => '&nbsp;', 'align' => 'center'),
			array('data' => '&nbsp;', 'align' => 'center'),
			array('data' => 'Total', 'align' => 'center'),
			array('data' => number_format($berat), 'align' => 'right'),
			array('data' => number_format($total), 'align' => 'right')
		);
		$data['table']=$this->table->generate();
		
		}
		$this->load->view('costcontrol/hargajenis',$data);
	
	}
}
