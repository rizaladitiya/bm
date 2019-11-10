<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Wip extends CI_Controller {
	private $limit=20;
	function __construct(){
		parent::__construct();
		
		if($this->session->userdata('status') != "login"){
			redirect(base_url("auth"));
		}
		$this->load->model('rumus_model','',TRUE);
		$this->load->library('user_agent');
		$this->load->helper(array('form','url','system_helper'));
	}
 
	function index(){
		//$hasil=hitungrumus(10,0.25,1);
		$hasil2=hitungrumus(10,0.25,3);
		echo $hasil2;
	}
	function add(){
		$data['rumus']=$this->rumus_model->get_rumus_group()->result();
		$data['kemasan']=(object)array();
		$data['std']=json_encode(array("id"=>"","nama"=>"","keterangan"=>"","id_rumus"=>"","simbol"=>"","namarumus"=>""));
		$this->load->view('wip/add.php',$data);
	}
	function addwip(){
		$data['wip']=(object)array();
		$this->load->view('wip/addwip.php',$data);
	}
	function master(){
		$id=$this->uri->segment(3);
		$rumus=$this->rumus_model->get_rumus($id)->result();
		$hasil=$rumus;
		/*
		$hasil=array();
		foreach($rumus as $value){
			$hasil[] = array($value->simbol,$value->namarumus,'');
			}
			*/
		$this->output->set_content_type('application/json');
		$callback = $this->input->get('callback',TRUE);
		if(empty($callback)){
			$this->output->set_output(json_encode($hasil));
		}else{
			$this->output->set_output($callback."(".json_encode($hasil).")");
		}
	}
	function hitung(){
		$data['rumus']=(object)array();
		$data['kemasan']=$this->rumus_model->get_kemasan_group()->result();
		$this->load->view('wip/hitung.php',$data);
		//echo json_encode($data['material']);
	}
	
	
	function update(){
		$data['rumus']=$this->rumus_model->get_rumus_group()->result();
		$data['kemasan']=$this->rumus_model->get_kemasan($this->uri->segment(3));
		$isitable=$data['kemasan'];
		$std = array();
		$result=$isitable->result();
		if(empty($result)){
			$std[] = array("id"=>"","nama"=>"","keterangan"=>"","id_rumus"=>"","simbol"=>"","namarumus"=>"","value"=>"");
		} else {
			$rumus=$this->rumus_model->get_rumus($isitable->row()->id_rumus)->result();
			$nama=array();
			$simbol=array();
			foreach($rumus as $value){
				$nama[]=$value->namarumus;
				$simbol[]=$value->simbol;
			}
			
			$i=0;
			foreach($isitable->result() as $value){
				$std[] = array("id"=>$value->id,"nama"=>$value->nama,"keterangan"=>$value->keterangan,"id_rumus"=>$value->id_rumus,"simbol"=>$simbol[$i],"namarumus"=>$nama[$i],"value"=>$value->value);
				$i++;
			}
		}
		$data['std']=json_encode($std);
		
		$alls=$this->rumus_model->get_kemasan($this->uri->segment(3))->result();
		foreach ($alls as $all) {
			$hasil=(object)array(
					'id'=>$all->id,
					'nama'=>$all->nama,
					'keterangan'=>$all->keterangan,
					'id_rumus'=>$all->id_rumus
					);
		}
		
		$data['kemasan']=$hasil;
		
		//echo $data['kemasan'];
		//echo json_encode($data['kemasan']);
		$this->load->view('wip/add.php',$data);
		
	}
	function view($offset=0,$order_column='nama',$order_type='asc'){
		$this->load->library(array('pagination','table'));
		
		if (empty($offset)) $offset=0;
		if (empty($order_column)) $order_column='nama';
		if (empty($order_type)) $order_type='asc';
		//TODO: check for valid column
		$alls=$this->rumus_model->get_paged_list($this->limit,
		$offset,$order_column,$order_type)->result();
		$config['base_url']= site_url('wip/view/');
		$config['total_rows']=$this->rumus_model->count_kemasan();
		$config['per_page']=$this->limit;
		$config['first_link'] = false; 
    	$config['last_link']  = false;
		$config['full_tag_open'] = '<ul class="pagination pagination-sm no-margin pull-right">';
		$config['full_tag_close'] = '</ul>';
		$config['first_tag_open'] = '<li>';
		$config['first_tag_close'] = '</li>';
		$config['last_tag_open'] = '<li>';
		$config['last_tag_close'] = '</li>';
		$config['prev_tag_open'] = '<li>';
		$config['prev_tag_close'] = '</li>';
		$config['next_tag_open'] = '<li>';
		$config['next_tag_close'] = '</li>';
		$config['cur_tag_open'] = '<li><a href="#"><b>';
		$config['cur_tag_close'] = '</b></a></li>';
		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';
		$config['last_link'] = '<i class="fa fa-angle-double-right"></i>';
		$config['first_link'] = '<i class="fa fa-angle-double-left"></i>';
    	$config ['prev_link'] = '<i class="fa fa-caret-left"></i>';
    	$config ['next_link'] = '<i class="fa fa-caret-right"></i>';
		//$config['uri_segment']=3;
		$this->pagination->initialize($config);
		$data['pagination']=$this->pagination->create_links();
		// generate table data
		$this->table->set_empty("&nbsp;");
		$tmpl = array ('table_open'=>'<table id="tabellaporan" class="table table-hover">');
		$this->table->set_template($tmpl); 
		$new_order=($order_type=='asc'?'desc':'asc');
		$this->table->set_heading(
		anchor('wip/view/'.$offset.'/nama/'.$new_order,'Kemasan'),
		anchor('wip/view/'.$offset.'/keterangan/'.$new_order,'Keterangan'),
		'&nbsp;',
		'&nbsp;'
		);
		$i=0+$offset;
		foreach ($alls as $all){
			$this->table->add_row(
				$all->nama,
				$all->keterangan,
				anchor('wip/update/'.$all->id,'&nbsp;',array('class'=>'fa fa-pencil')),
				anchor('wip/delete/'.$all->id,'&nbsp;',array('class'=>'fa fa-trash','onclick'=>"return confirm('Apakah Anda yakin ingin menghapus kemasan ini?')"))
			);
		}
		$data['table']=$this->table->generate();
		$this->load->view('wip/view.php',$data);
		
	}
	function viewchem($offset=0,$order_column='nama',$order_type='asc'){
		$this->load->library(array('pagination','table'));
		
		if (empty($offset)) $offset=0;
		if (empty($order_column)) $order_column='nama';
		if (empty($order_type)) $order_type='asc';
		//TODO: check for valid column
		$alls=$this->rumus_model->get_paged_list($this->limit,
		$offset,$order_column,$order_type)->result();
		$config['base_url']= site_url('wip/view/');
		$config['total_rows']=$this->rumus_model->count_kemasan();
		$config['per_page']=$this->limit;
		$config['first_link'] = false; 
    	$config['last_link']  = false;
		$config['full_tag_open'] = '<ul class="pagination pagination-sm no-margin pull-right">';
		$config['full_tag_close'] = '</ul>';
		$config['first_tag_open'] = '<li>';
		$config['first_tag_close'] = '</li>';
		$config['last_tag_open'] = '<li>';
		$config['last_tag_close'] = '</li>';
		$config['prev_tag_open'] = '<li>';
		$config['prev_tag_close'] = '</li>';
		$config['next_tag_open'] = '<li>';
		$config['next_tag_close'] = '</li>';
		$config['cur_tag_open'] = '<li><a href="#"><b>';
		$config['cur_tag_close'] = '</b></a></li>';
		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';
		$config['last_link'] = '<i class="fa fa-angle-double-right"></i>';
		$config['first_link'] = '<i class="fa fa-angle-double-left"></i>';
    	$config ['prev_link'] = '<i class="fa fa-caret-left"></i>';
    	$config ['next_link'] = '<i class="fa fa-caret-right"></i>';
		//$config['uri_segment']=3;
		$this->pagination->initialize($config);
		$data['pagination']=$this->pagination->create_links();
		// generate table data
		$this->table->set_empty("&nbsp;");
		$tmpl = array ('table_open'=>'<table id="tabellaporan" class="table table-hover">');
		$this->table->set_template($tmpl); 
		$new_order=($order_type=='asc'?'desc':'asc');
		$this->table->set_heading(
		anchor('wip/view/'.$offset.'/nama/'.$new_order,'Kemasan'),
		anchor('wip/view/'.$offset.'/keterangan/'.$new_order,'Keterangan'),
		'&nbsp;',
		'&nbsp;'
		);
		$i=0+$offset;
		foreach ($alls as $all){
			$this->table->add_row(
				$all->nama,
				$all->keterangan,
				anchor('wip/update/'.$all->id,'&nbsp;',array('class'=>'fa fa-pencil')),
				anchor('wip/delete/'.$all->id,'&nbsp;',array('class'=>'fa fa-trash','onclick'=>"return confirm('Apakah Anda yakin ingin menghapus kemasan ini?')"))
			);
		}
		$data['table']=$this->table->generate();
		$this->load->view('wip/view.php',$data);
		
	}
	function last(){
		$alls=$this->rumus_model->get_by_last()->result();
		$this->output->set_content_type('application/json');
		$callback = $this->input->get('callback',TRUE);
		if(empty($callback)){
			$this->output->set_output(json_encode($alls));
		}else{
			$this->output->set_output($callback."(".json_encode($alls).")");
		}
	}
	
	
	
	function delete(){
		$id = $this->uri->segment(3);
		$this->grinding_model->delete($id);
		redirect($this->agent->referrer());
		}
	function savemaster(){
		if($this->input->post('id')==0){
			$kemasan = array(
					'nama'=>$this->input->post('nama'),
					'keterangan'=>$this->input->post('keterangan'),
					'id_rumus'=>$this->input->post('id_rumus')
					);
			$point['point']=array();
			
			foreach(json_decode($this->input->post('array')) as $value){
				$point['point'][] = $value[2];
			}
			
			$id = $this->rumus_model->add_kemasan($kemasan);
			$this->rumus_model->add_kemasan_point($point['point'],$id);
		} else {
			$kemasan = array(
					'nama'=>$this->input->post('nama'),
					'keterangan'=>$this->input->post('keterangan'),
					'id_rumus'=>$this->input->post('id_rumus')
					);
			$point['point']=array();
			
			foreach(json_decode($this->input->post('array')) as $value){
				$point['point'][] = $value[2];
			}
			$this->rumus_model->update_kemasan($this->input->post('id'),$kemasan);
			$this->rumus_model->delete_child_by_parrent($this->input->post('id'));
			$this->rumus_model->add_kemasan_point($point['point'],$this->input->post('id'));
		}
	}
}
