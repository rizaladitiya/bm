<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Wiring extends CI_Controller {
	private $limit=20;
	
	function __construct(){
		parent::__construct();
		error_reporting(0);
		if($this->session->userdata('status') != "login"){
			redirect(base_url("auth"));
		}
		$this->load->library('user_agent');
		$this->load->helper(array('form','url','system_helper'));
		$this->load->model('wiring/wiring_model','',TRUE);
		$this->load->model('wiring/checklist_model','',TRUE);
		
	}
 
	function index(){
		$jenis=$this->wiring_model->get_by_all()->result();
		$this->output->set_content_type('application/json');
		$callback = $this->input->get('callback',TRUE);
		if(empty($callback)){
			$this->output->set_output(json_encode($jenis));
		}else{
			$this->output->set_output($callback."(".json_encode($jenis).")");
		}
	}
	function jsonplcbymachine(){

		$machine=$this->input->post('machine');
		$jenis=$this->wiring_model->get_plc_by_machine($machine)->result();
		$this->output->set_content_type('application/json');
		$callback = $this->input->get('callback',TRUE);
		if(empty($callback)){
			$this->output->set_output(json_encode($jenis));
		}else{
			$this->output->set_output($callback."(".json_encode($jenis).")");
		}
	}
	function jsoninstrumentbyplc(){

		$plc=$this->input->post('plc');
		$jenis=$this->wiring_model->get_instrument_by_plc($plc)->result();
		$this->output->set_content_type('application/json');
		$callback = $this->input->get('callback',TRUE);
		if(empty($callback)){
			$this->output->set_output(json_encode($jenis));
		}else{
			$this->output->set_output($callback."(".json_encode($jenis).")");
		}
	}
	function updatehandsontable(){
		$data=json_decode($this->input->post('data'));
		$arrupdate=array();
		
		foreach($data as $value){
				//$arrupdate['id'][] = $value[0];
				$arrupdate=array(
									"devicetag"=>$value[1],
									"description"=>$value[2],
									"card_type"=>$value[3],
									"signal_type"=>$value[4],
									"io_panel"=>$value[6],
									"signal"=>$value[7],
									"relay"=>$value[8],
									"terminal"=>$value[9],
									"terminal2"=>$value[10],
									"jb"=>$value[11],
									"jb_terminal"=>$value[12],
								);

				$this->wiring_model->update($value[0],$arrupdate);

				//echo $this->db->last_query();
				//$this->output->set_output(json_encode($arrupdate));
			}
		echo "success";
		//$this->output->set_output(json_encode($arrupdate));
	}
	function jsonwiringfromplc(){

		$plc=$this->input->post('plc');
		$alls=$this->wiring_model->get_by_plc($plc)->result();
		$table = array();
		if(empty($alls)){
				$table[] = array(
					"",
					"",
					"",
					"",
					"",
					"",
					"",
					"",
					"",
					"",
					"",
					"",
					"",
					"",
					""
				);
			
		} else {
			foreach($alls as $value){
				$lastchecked=$this->checklist_model->get_last_checked($value->id)->row()->tanggal;
				$lastuser=$this->checklist_model->get_last_checked($value->id)->row()->user;
				$table[] = array(
					$value->id,
					$value->devicetag,
					$value->description,
					$value->card_type,
					$value->signal_type,
					$value->node.":".$value->card.":".$value->channel,
					$value->io_panel,
					$value->signal,
					$value->relay,
					$value->terminal,
					$value->terminal2,
					$value->jb,
					$value->jb_terminal,
					$lastchecked,
					$lastuser
				);
			}
		}
		$jenis=$table;
		$this->output->set_content_type('application/json');
		$callback = $this->input->get('callback',TRUE);
		if(empty($callback)){
			$this->output->set_output(json_encode($jenis));
		}else{
			$this->output->set_output($callback."(".json_encode($jenis).")");
		}
	}
	function jsonwiringfromplcinstrument(){

		$plc=$this->input->post('plc');
		$instrument=$this->input->post('instrument');
		$alls=$this->wiring_model->get_by_plc_instrument($plc,$instrument)->result();
		$table = array();
		if(empty($alls)){
				$table[] = array(
					"",
					"",
					"",
					"",
					"",
					"",
					"",
					"",
					"",
					"",
					"",
					"",
					"",
					"",
					""
				);
			
		} else {
			foreach($alls as $value){
				$lastchecked=$this->checklist_model->get_last_checked($value->id)->row()->tanggal;
				$lastuser=$this->checklist_model->get_last_checked($value->id)->row()->user;
				$table[] = array(
					$value->id,
					$value->devicetag,
					$value->description,
					$value->card_type,
					$value->signal_type,
					$value->node.":".$value->card.":".$value->channel,
					$value->io_panel,
					$value->signal,
					$value->relay,
					$value->terminal,
					$value->terminal2,
					$value->jb,
					$value->jb_terminal,
					$lastchecked,
					$lastuser
				);
			}
		}
		$jenis=$table;
		$this->output->set_content_type('application/json');
		$callback = $this->input->get('callback',TRUE);
		if(empty($callback)){
			$this->output->set_output(json_encode($jenis));
		}else{
			$this->output->set_output($callback."(".json_encode($jenis).")");
		}
	}
	function addpp(){
		
		
		$this->load->view('gudang/addpp.php',$data);
		
	}
	function view(){
		$data['machine']=$this->wiring_model->get_machine()->result();
		$table = array();
		if(empty($alls)){
				$table[] = array(
					"",
					"",
					"",
					"",
					"",
					"",
					"",
					"",
					"",
					"",
					"",
					"",
					"",
					"",
					"",
					""
				);
			
		} else {
			foreach($alls as $value){
				$lastchecked=$this->checklist_model->get_last_checked($value->id)->row()->tanggal;
				$lastuser=$this->checklist_model->get_last_checked($value->id)->row()->user;
				$table[] = array(
					$value->id,
					$value->looptag,
					$value->devicetag,
					$value->description,
					$value->card_type,
					$value->signal_type,
					$value->node.":".$value->card.":".$value->channel,
					$value->io_panel,
					$value->signal,
					$value->relay,
					$value->terminal,
					$value->terminal2,
					$value->jb,
					$value->jb_terminal,
					$lastchecked,
					$lastuser
				);
			}
		}
		$data['table']=json_encode($table);
		$this->load->view('wiring/viewwiring.php',$data);
	}
	
	
}
