<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Grinding extends CI_Controller {
	private $limit=20;
	function __construct(){
		parent::__construct();
		
		if($this->session->userdata('status') != "login"){
			redirect(base_url("auth"));
		}
		$this->load->model('grinding_model','',TRUE);
		$this->load->library('user_agent');
		$this->load->helper(array('form'));
	}
 
	function add(){
		$data['grinding']=(object)array();
		$data['material']=$this->grinding_model->get_material_all()->result();
		$std = array();
		foreach($this->grinding_model->get_standard()->result() as $value){
			$std[] = array($value->point,'','');
			}
		$data['std']=json_encode($std);
		$this->load->view('grinding/add.php',$data);
		//echo $data['std'];
	}
	function add2(){
		$data['grinding']=(object)array();
		$data['material']=$this->grinding_model->get_material_all()->result();
		$this->load->view('grinding/add2.php',$data);
		//echo json_encode($data['material']);
	}
	
	function index(){
		//$data['grinding']=(object)array();
		//$this->load->view('grinding/add2.php',$data);
		redirect(base_url('grinding/view'));
	}
	function update(){
		$isitabel=$this->grinding_model->get_child_by_parrent($this->uri->segment(3))->result();
		$std = array();
		if(empty($isitabel)){
			$isitabel=$this->grinding_model->get_standard()->result();
			foreach($isitabel as $value){
				$std[] = array($value->point,'','');
			}
			
		} else {
			foreach($isitabel as $value){
				$std[] = array($value->point,$value->before,$value->after);
			}
		}
		$data['std']=json_encode($std);
		$alls=$this->grinding_model->get_by_id($this->uri->segment(3))->result();
		foreach ($alls as $all) {
			$hasil=(object)array(
					'id'=>$all->id,
					'customer'=>$all->customer,
					'location'=>$all->location,
					'number'=>$all->number,
					'before'=>$all->before,
					'after'=>$all->after,
					'face_length'=>$all->face_length,
					'crowning'=>$all->crowning,
					'material'=>$all->material,
					'tolerance'=>$all->tolerance,
					'hardness'=>$all->hardness,
					'surface'=>$all->surface,
					'roundness'=>$all->roundness,
					'date_start'=>date('Y-m-d',strtotime($all->date_start)),
					'date_finish'=>date('Y-m-d',strtotime($all->date_finish)),
					'operator'=>$all->operator,
					'remark'=>$all->remark,
					);
		}
		$data['material']=$this->grinding_model->get_material_all()->result();
		$data['grinding']=$hasil;
		$this->load->view('grinding/add.php',$data);
		
	}
	function view($offset=0,$order_column='id',$order_type='desc'){
		$this->load->library(array('pagination','table'));
		if (empty($offset)) $offset=0;
		if (empty($order_column)) $order_column='id';
		if (empty($order_type)) $order_type='desc';
		//TODO: check for valid column
		$alls=$this->grinding_model->get_paged_list($this->limit,
		$offset,$order_column,$order_type)->result();
		$config['base_url']= site_url('grinding/view/');
		$config['total_rows']=$this->grinding_model->count_all();
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
		'&nbsp;',
		anchor('grinding/view/'.$offset.'/customer/'.$new_order,'Customer'),
		anchor('grinding/view/'.$offset.'/location/'.$new_order,'Type<br>Location'),
		anchor('grinding/view/'.$offset.'/number/'.$new_order,'Roll<br>Number'),
		'Before<br>Diameter',
        'After<br>Diameter',
        'Face<br>Length',
		'Crowning',
        anchor('grinding/view/'.$offset.'/material/'.$new_order,'Material'),
		'Tolerance',
        'Hardness',
		'Surface',
        'Roundness',
        anchor('grinding/view/'.$offset.'/date_start/'.$new_order,'Date<br>Start'),
		anchor('grinding/view/'.$offset.'/date_finish/'.$new_order,'Date<br>Finish'),
		'Operator',
		'Remarks',
		'&nbsp;',
		'&nbsp;'
		);
		$i=0+$offset;
		foreach ($alls as $all){
			$namamaterial=$this->grinding_model->get_material_by_id($all->material)->row();
			$this->table->add_row(
				anchor('grinding/cetak/'.$all->id,'&nbsp;',array('target' => '_blank','class'=>'fa fa-print')),
				$all->customer,
				$all->location,
				$all->number,
				$all->before,
				$all->after,
				$all->face_length,
				$all->crowning,
				$namamaterial->nama,
				$all->tolerance,
				$all->hardness,
				$all->surface,
				$all->roundness,
				date('d-M-y',strtotime($all->date_start)),
				date('d-M-y',strtotime($all->date_finish)),
				$all->operator,
				$all->remark,
				anchor('grinding/update/'.$all->id,'&nbsp;',array('class'=>'fa fa-pencil')),
				anchor('grinding/delete/'.$all->id,'&nbsp;',array('class'=>'fa fa-trash','onclick'=>"return confirm('Apakah Anda yakin ingin menghapus grinding ini?')"))
			);
		}
		$data['table']=$this->table->generate();
	
		$this->load->view('grinding/view.php',$data);
		
	}
	function last(){
		$alls=$this->grinding_model->get_by_last()->result();
		$this->output->set_content_type('application/json');
		$callback = $this->input->get('callback',TRUE);
		if(empty($callback)){
			$this->output->set_output(json_encode($alls));
		}else{
			$this->output->set_output($callback."(".json_encode($alls).")");
		}
	}
	
	function cetak(){
		$id=$this->uri->segment(3);
		$alls=$this->grinding_model->get_by_id($id)->result();
		$data['isitabel'] = $this->grinding_model->get_child_by_parrent($id)->result();
		$data['point'] = array();
		$data['actual'] = array();
		$data['standard'] = array();
		$crown=0;
		foreach($this->grinding_model->get_child_by_parrent($id)->result() as $value){
			$data['point'][] = $value->point;
			$data['actual'][] = (float) $value->after;
		}
		foreach($this->grinding_model->get_standard()->result() as $value){
			$data['standard'][] = (float) $value->standard;
		}
		
		foreach ($alls as $all) {
			$namamaterial=$this->grinding_model->get_material_by_id($all->material)->row();
			$crown=$all->crowning;
			$hasil=(object)array(
								'id'=>$all->id,
								'customer'=>$all->customer,
								'location'=>$all->location,
								'number'=>$all->number,
								'before'=>$all->before,
								'after'=>$all->after,
								'face_length'=>$all->face_length,
								'crowning'=>$all->crowning,
								'material'=>$namamaterial->nama,
								'tolerance'=>$all->tolerance,
								'hardness'=>$all->hardness,
								'surface'=>$all->surface,
								'roundness'=>$all->roundness,
								'date_start'=>date('Y-m-d',strtotime($all->date_start)),
								'date_finish'=>date('Y-m-d',strtotime($all->date_finish)),
								'operator'=>$all->operator,
								'remark'=>$all->remark,
								);
		}
		$data['grinding']=$hasil;
		$data['refer']=$this->agent->referrer();
		if ($crown==0)
			$this->load->view('grinding/cetak.php',$data);
		else
			$this->load->view('grinding/cetak2.php',$data);
	}
	
	function cetak2(){
		$id=$this->uri->segment(3);
		$alls=$this->grinding_model->get_by_id($id)->result();
		$data['isitabel'] = $this->grinding_model->get_child_by_parrent($id)->result();
		$data['point'] = array();
		$data['actual'] = array();
		$data['standard'] = array();
		foreach($this->grinding_model->get_child_by_parrent($id)->result() as $value){
			$data['point'][] = $value->point;
			$data['actual'][] = (float) $value->after;
		}
		foreach($this->grinding_model->get_standard()->result() as $value){
			$data['standard'][] = (float) $value->standard;
		}
		
		foreach ($alls as $all) {
			$namamaterial=$this->grinding_model->get_material_by_id($all->material)->row();
			$hasil=(object)array(
								'id'=>$all->id,
								'customer'=>$all->customer,
								'location'=>$all->location,
								'number'=>$all->number,
								'before'=>$all->before,
								'after'=>$all->after,
								'face_length'=>$all->face_length,
								'crowning'=>$all->crowning,
								'material'=>$namamaterial->nama,
								'tolerance'=>$all->tolerance,
								'hardness'=>$all->hardness,
								'surface'=>$all->surface,
								'roundness'=>$all->roundness,
								'date_start'=>date('Y-m-d',strtotime($all->date_start)),
								'date_finish'=>date('Y-m-d',strtotime($all->date_finish)),
								'operator'=>$all->operator,
								'remark'=>$all->remark,
								);
		}
		$data['grinding']=$hasil;
		$data['refer']=$this->agent->referrer();
		$this->load->view('grinding/cetak2.php',$data);
	}
	
	function delete(){
		$id = $this->uri->segment(3);
		$this->grinding_model->delete($id);
		redirect($this->agent->referrer());
		}
	function save(){
		if($this->input->post('id')==0){
			$grinding = array(
					'date_start'=>date('Y-m-d',strtotime($this->input->post('date_start'))),
					'date_finish'=>date('Y-m-d',strtotime($this->input->post('date_finish'))),
					'customer'=>$this->input->post('customer'),
					'location'=>$this->input->post('location'),
					'number'=>$this->input->post('number'),
					'before'=>$this->input->post('before'),
					'after'=>$this->input->post('after'),
					'face_length'=>$this->input->post('face_length'),
					'crowning'=>$this->input->post('crowning'),
					'material'=>$this->input->post('material'),
					'tolerance'=>$this->input->post('tolerance'),
					'hardness'=>$this->input->post('hardness'),
					'surface'=>$this->input->post('surface'),
					'roundness'=>$this->input->post('roundness'),
					'operator'=>$this->input->post('operator'),
					'remark'=>$this->input->post('remark'),
					'reported'=>$this->input->post('reported'),
					'datetime'=>now()
					);
			$point['before']=array();
			$point['after']=array();
			
			foreach(json_decode($this->input->post('array')) as $value){
				$point['point'][] = $value[0];
				$point['before'][] = round($value[1],3);
				$point['after'][] = round($value[2],3);
			}
			
			$id = $this->grinding_model->add($grinding);
			$this->grinding_model->add_point($point,$id);
		} else {
			$grinding = array(
					'date_start'=>date('Y-m-d',strtotime($this->input->post('date_start'))),
					'date_finish'=>date('Y-m-d',strtotime($this->input->post('date_finish'))),
					'customer'=>$this->input->post('customer'),
					'location'=>$this->input->post('location'),
					'number'=>$this->input->post('number'),
					'before'=>$this->input->post('before'),
					'after'=>$this->input->post('after'),
					'face_length'=>$this->input->post('face_length'),
					'crowning'=>$this->input->post('crowning'),
					'tolerance'=>$this->input->post('tolerance'),
					'material'=>$this->input->post('material'),
					'hardness'=>$this->input->post('hardness'),
					'surface'=>$this->input->post('surface'),
					'roundness'=>$this->input->post('roundness'),
					'operator'=>$this->input->post('operator'),
					'remark'=>$this->input->post('remark'),
					'reported'=>$this->input->post('reported')
					);
			$point['before']=array();
			$point['after']=array();
			
			foreach(json_decode($this->input->post('array')) as $value){
				$point['point'][] = $value[0];
				$point['before'][] = round($value[1],3);
				$point['after'][] = round($value[2],3);
			}
			$this->grinding_model->update($this->input->post('id'),$grinding);
			$this->grinding_model->delete_child_by_parrent($this->input->post('id'));
			$this->grinding_model->add_point($point,$this->input->post('id'));
			//echo json_encode($point);
		}
	}
}
