<?php
	class Plan extends CI_Controller {

	private $limit=10;

	function __construct()
	{
	parent::__construct();
	#load library dan helper yang dibutuhkan
	$this->load->library(array('table','form_validation','user_agent'));
	$this->load->helper(array('form','url','system_helper'));
	$this->load->model('plan_model','',TRUE);
	$this->load->model('tmpgrupbarang_model','',TRUE);
	//ini_set('max_execution_time', 0); 
	ini_set('memory_limit','2048M');
	set_time_limit(0);
	}
	
	
	function email(){
		//$pm=$this->uri->segment(3);
		//$tgl=$this->uri->segment(4);
		//$tgl2=$this->uri->segment(5);
		$sekarang = date('Y-m-d');
		$kemarin = date( "Y-m-d", strtotime("$sekarang -1 days"));
		$minggudepan = date( "Y-m-d", strtotime("$sekarang +7 days"));
		$select = $this->plan_model->get_group_by_lap($kemarin,$minggudepan,1);
		$select2 = $this->plan_model->get_group_by_lap($kemarin,$minggudepan,2);
		$url=json_decode(file_get_contents("http://".server()."/api/barang/hasilprod/0/".$kemarin."/".$minggudepan));
		$master=json_decode(file_get_contents("http://".server()."/api/master/barang"));
		$data['masterjenis'] = $master->jenis;
		$data['masterwarna'] = $master->warna;
		$data['masterharga'] = $this->plan_model->get_masterharga()->result();
		$data['awal']=$kemarin;
		$data['akhir']=$minggudepan;
		if(($select->num_rows()>0 or $select2->num_rows()>0) and count($url)>0)
		{
		$this->tmpgrupbarang_model->add_batch($url);
		}
		else
		{ /* there is nothing to insert */
		}
		$data['pm1']=$select->result();
		$data['pm2']=$select2->result();
		$data['remote']=$url;
		$this->load->view('plan/planProduksi',$data);
	}
	
	
	
	}