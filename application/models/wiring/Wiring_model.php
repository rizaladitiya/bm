<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Wiring_model extends CI_Model {
		private $db2;
 		private $primary_key='id';
		private $table_name='main_wiring';

 public function __construct()
 {
  parent::__construct();
        $this->db2 = $this->load->database('wiring', TRUE);
 }
 function get_by_all(){
	$select=array(
				'main_wiring.id',
				'main_wiring.looptag',
				'main_wiring.devicetag',
				'main_wiring.description',
				'main_wiring.card_type',
				'main_wiring.signal_type',
				'main_wiring.node',
				'main_wiring.card',
				'main_wiring.channel',
				'main_wiring.plc',
				'main_wiring.io_panel',
				'main_wiring.signal',
				'main_wiring.cc_panel',
				'main_wiring.relay',
				'main_wiring.tb_set',
				'main_wiring.terminal',
				'main_wiring.terminal2',
				'main_wiring.jb',
				'main_wiring.jb_terminal',
				'plc.brand as plcbrand',
				'plc.name as plcname',
				'machine.name as machinename'
			);
	$this->db2->select($select);  
	$this->db2->from($this->table_name);
	$this->db2->join('plc', 'plc.id = main_wiring.plc', 'left');
	$this->db2->join('machine', 'plc.machine = machine.id', 'left');
	$this->db2->order_by('id asc');
	return $this->db2->get();
}
function get_plc(){
	$this->db2->select();  
	$this->db2->from('plc');
	$this->db2->order_by('id asc');
	return $this->db2->get();
}
function get_plc_by_machine($machine){
	$this->db2->select();  
	$this->db2->from('plc');
	$this->db2->where('machine',$machine);
	$this->db2->order_by('id asc');
	return $this->db2->get();
}
function get_instrument_by_plc($plc){
	$this->db2->select('instrument');  
	$this->db2->from('main_wiring');
	$this->db2->where('plc',$plc);
	$this->db2->group_by('instrument'); 
	$this->db2->order_by('instrument asc');
	return $this->db2->get();
}
function get_machine(){
	$this->db2->select();  
	$this->db2->from('machine');
	$this->db2->order_by('name asc');
	return $this->db2->get();
}
function get_by_id($id){
	$select=array(
				'main_wiring.id',
				'main_wiring.looptag',
				'main_wiring.devicetag',
				'main_wiring.description',
				'main_wiring.card_type',
				'main_wiring.signal_type',
				'main_wiring.node',
				'main_wiring.card',
				'main_wiring.channel',
				'main_wiring.plc',
				'main_wiring.io_panel',
				'main_wiring.signal',
				'main_wiring.cc_panel',
				'main_wiring.relay',
				'main_wiring.tb_set',
				'main_wiring.terminal',
				'main_wiring.terminal2',
				'main_wiring.jb',
				'main_wiring.jb_terminal',
				'plc.brand as plcbrand',
				'plc.name as plcname',
				'machine.name as machinename'
			);
	$this->db2->select($select);    
	$this->db2->from($this->table_name);
	$this->db2->join('plc', 'plc.id = main_wiring.plc', 'left');
	$this->db2->join('machine', 'plc.machine = machine.id', 'left');
	$this->db2->where('id',$id);
	return $this->db2->get();
}
function get_by_plc($plc){
	$select=array(
				'main_wiring.id',
				'main_wiring.looptag',
				'main_wiring.devicetag',
				'main_wiring.description',
				'main_wiring.card_type',
				'main_wiring.signal_type',
				'main_wiring.node',
				'main_wiring.card',
				'main_wiring.channel',
				'main_wiring.plc',
				'main_wiring.io_panel',
				'main_wiring.signal',
				'main_wiring.cc_panel',
				'main_wiring.relay',
				'main_wiring.tb_set',
				'main_wiring.terminal',
				'main_wiring.terminal2',
				'main_wiring.jb',
				'main_wiring.jb_terminal',
				'plc.brand as plcbrand',
				'plc.name as plcname',
				'machine.name as machinename'
			);
	$where=array(
			'plc'=> $plc
			);
	$this->db2->select($select);    
	$this->db2->from($this->table_name);
	$this->db2->join('plc', 'plc.id = main_wiring.plc', 'left');
	$this->db2->join('machine', 'plc.machine = machine.id', 'left');
	$this->db2->where($where);
	return $this->db2->get();
}
function get_by_plc_instrument($plc,$instrument){
	$select=array(
				'main_wiring.id',
				'main_wiring.looptag',
				'main_wiring.devicetag',
				'main_wiring.description',
				'main_wiring.card_type',
				'main_wiring.signal_type',
				'main_wiring.node',
				'main_wiring.card',
				'main_wiring.channel',
				'main_wiring.plc',
				'main_wiring.io_panel',
				'main_wiring.signal',
				'main_wiring.cc_panel',
				'main_wiring.relay',
				'main_wiring.tb_set',
				'main_wiring.terminal',
				'main_wiring.terminal2',
				'main_wiring.jb',
				'main_wiring.jb_terminal',
				'plc.brand as plcbrand',
				'plc.name as plcname',
				'machine.name as machinename'
			);
	$where=array(
			'plc'=> $plc,
			'instrument'=> $instrument
			);
	$this->db2->select($select);    
	$this->db2->from($this->table_name);
	$this->db2->join('plc', 'plc.id = main_wiring.plc', 'left');
	$this->db2->join('machine', 'plc.machine = machine.id', 'left');
	$this->db2->where($where);
	return $this->db2->get();
}

function get_search($keyword){
	$select=array(
				'main_wiring.id',
				'main_wiring.looptag',
				'main_wiring.devicetag',
				'main_wiring.description',
				'main_wiring.card_type',
				'main_wiring.signal_type',
				'main_wiring.node',
				'main_wiring.card',
				'main_wiring.channel',
				'main_wiring.plc',
				'main_wiring.io_panel',
				'main_wiring.signal',
				'main_wiring.cc_panel',
				'main_wiring.relay',
				'main_wiring.tb_set',
				'main_wiring.terminal',
				'main_wiring.terminal2',
				'main_wiring.jb',
				'main_wiring.jb_terminal',
				'plc.brand as plcbrand',
				'plc.name as plcname',
				'machine.name as machinename'
			);
	$this->db2->select($select);    
	$this->db2->from($this->table_name);
	$this->db2->join('plc', 'plc.id = main_wiring.plc', 'left');
	$this->db2->join('machine', 'plc.machine = machine.id', 'left');
	$this->db2->like('main_wiring.devicetag',$keyword);
	$this->db2->or_like('main_wiring.looptag', $keyword);
	$this->db2->or_like('main_wiring.description', $keyword);
	$this->db2->order_by('main_wiring.devicetag asc');
	$this->db2->limit(10);
	return $this->db2->get();
}
function add($data){
	$this->db2->insert($this->table_name,$data);
	return $this->db2->insert_id();
}
function update($id,$data) {
	$this->db2->where('id',$id);
	$this->db2->update($this->table_name,$data);
}
} 