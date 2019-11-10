<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Checklist extends CI_Controller {
	private $limit=20;
	function __construct(){
		parent::__construct();
		
		if($this->session->userdata('status') != "login"){
			redirect(base_url("auth"));
		}
		$this->load->library('user_agent');
		$this->load->helper(array('form','url','system_helper'));
		$this->load->model('wiring/checklist_model','',TRUE);
		$this->load->model('wiring/laporan_model','',TRUE);
	}
 
	function index(){
	}
	function addpp(){
		
		
		$this->load->view('gudang/addpp.php',$data);
		
	}
	function viewcheklist(){
	
		$this->load->view('gudang/viewpp.php',$data);
	}
	function checklisttgl(){
		$checklist=null;
		$cektgl=$this->input->post('tgl');
		$cektgl2=$this->input->post('tgl2');
		$this->load->library(array('table'));
		if(empty($cektgl)){
			$cektgl=sekarang();
		}
		if(empty($cektgl2)){
			$cektgl2=$cektgl;
		}
		$checklist = $this->checklist_model->get_by_tgl($cektgl,$cektgl2)->result();
		$this->table->set_empty("&nbsp;");
		$tmpl = array ('table_open'=>'<table width="100%" border="1" cellspacing="0" cellpadding="0" id="tabellaporan">');
		$this->table->set_template($tmpl); 
		$this->table->set_heading(
		'id',
		'devicetag',
		array('data' => 'Description', 'align' => 'right'),
		'brand',
		'name',
		'user',
		'regulator',
		'label',
		'wrapping',
		'keterangan',
		'tanggal'
		);
		$i=1;
			foreach ($checklist as $arr){
			$this->table->add_row(
				array('data' => $i, 'align' => 'center'),
				array('data' => $arr->devicetag, 'align' => 'center'),
				array('data' => $arr->description, 'align' => 'left'),
				array('data' => $arr->brand, 'align' => 'center'),
				array('data' => $arr->name, 'align' => 'center'),
				array('data' => $arr->user, 'align' => 'center'),
				array('data' => ada($arr->regulator), 'align' => 'center'),
				array('data' => ada($arr->wrapping), 'align' => 'center'),
				array('data' => ada($arr->label), 'align' => 'center'),
				array('data' => $arr->keterangan, 'align' => 'center'),
				array('data' => tglshort($arr->waktu), 'align' => 'right')
			);
			
			$i++;
			}
		
		$data['table']=$this->table->generate();
		
		//print_r($checklist);
		$this->load->view('wiring/checklisttgl.php',$data);
	}
	
	function laporantgl(){
		$laporan=null;
		$cektgl=$this->input->post('tgl');
		$cektgl2=$this->input->post('tgl2');
		$this->load->library(array('table'));
		if(empty($cektgl)){
			$cektgl=sekarang();
		}
		if(empty($cektgl2)){
			$cektgl2=$cektgl;
		}
		$laporan = $this->laporan_model->get_by_tgl($cektgl,$cektgl2)->result();
		$this->table->set_empty("&nbsp;");
		$tmpl = array ('table_open'=>'<table width="100%" border="1" cellspacing="0" cellpadding="0" id="tabellaporan">');
		$this->table->set_template($tmpl); 
		$this->table->set_heading(
		'id',
		'Masalah',
		'Tindakan',
		'Koreksi',
		'Keterangan',
		'Device Tag',
		'Tanggal',
		'Dari',
		'Hingga',
		'User'
		);
		$i=1;
			foreach ($laporan as $arr){
			$this->table->add_row(
				array('data' => $i, 'align' => 'center'),
				array('data' => $arr->masalah, 'align' => 'center'),
				array('data' => $arr->tindakan, 'align' => 'left'),
				array('data' => $arr->koreksi, 'align' => 'center'),
				array('data' => $arr->keterangan, 'align' => 'center'),
				array('data' => $arr->devicetag, 'align' => 'center'),
				array('data' => $arr->tanggal, 'align' => 'center'),
				array('data' => $arr->dari, 'align' => 'center'),
				array('data' => $arr->hingga, 'align' => 'center'),
				array('data' => $arr->user, 'align' => 'center')
			);
			
			$i++;
			}
		
		$data['table']=$this->table->generate();
		
		//print_r($checklist);
		$this->load->view('wiring/laporantgl.php',$data);
	}
	
	
}
