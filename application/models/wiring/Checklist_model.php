<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Checklist_model extends CI_Model {
		private $db2;
 		private $primary_key='id';
		private $table_name='checklist';

 public function __construct()
 {
  parent::__construct();
        $this->db2 = $this->load->database('wiring', TRUE);
 }
 function get_by_all(){
	$select=array(
				'checklist.id',
				'main_wiring.devicetag',
				'main_wiring.description',
				'plc.brand',
				'plc.name',
				'checklist.user',
				'checklist.regulator',
				'checklist.keterangan',
				'checklist.waktu',
				'checklist.tanggal'
			);
	$this->db2->select();  
	$this->db2->from($this->table_name);
	$this->db2->join('main_wiring', 'checklist.main_wiring = main_wiring.id', 'left');
	$this->db2->join('plc', 'plc.id = main_wiring.plc', 'left');
	$this->db2->order_by('id asc');
	return $this->db2->get();
}
function get_by_id($id){
	$select=array(
				'checklist.id',
				'main_wiring.devicetag',
				'main_wiring.description',
				'plc.brand',
				'plc.name',
				'checklist.user',
				'checklist.regulator',
				'checklist.keterangan',
				'checklist.label',
				'checklist.wrapping',
				'checklist.waktu',
				'checklist.tanggal'
			);
	$this->db2->select($select);    
	$this->db2->from($this->table_name);
	$this->db2->join('main_wiring', 'checklist.main_wiring = main_wiring.id', 'left');
	$this->db2->join('plc', 'plc.id = main_wiring.plc', 'left');
	$this->db2->where('id',$id);
	return $this->db2->get();
}
function get_last_checked($id){
	$select=array(
				'checklist.id',
				'main_wiring.devicetag',
				'main_wiring.description',
				'plc.brand',
				'plc.name',
				'checklist.user',
				'checklist.regulator',
				'checklist.keterangan',
				'checklist.label',
				'checklist.wrapping',
				'checklist.waktu',
				'checklist.tanggal'
			);
	
	$this->db2->select($select);    
	$this->db2->from("checklist");
	$this->db2->join('main_wiring', 'checklist.main_wiring = main_wiring.id', 'left');
	$this->db2->join('plc', 'plc.id = main_wiring.plc', 'left');
	$this->db2->where('checklist.main_wiring',$id);
	$this->db2->order_by('tanggal desc');
	$this->db2->limit(1);
	return $this->db2->get();
}
function get_by_tgl($tgl,$tgl2){
	$select=array(
				'checklist.id',
				'main_wiring.devicetag',
				'main_wiring.description',
				'plc.brand',
				'plc.name',
				'checklist.user',
				'checklist.regulator',
				'checklist.keterangan',
				'checklist.label',
				'checklist.wrapping',
				'checklist.waktu',
				'checklist.tanggal'
			);
	$where=array(
			'checklist.tanggal >='=> $tgl,
			'checklist.tanggal <='=> $tgl2
			);
	$this->db2->select($select);    
	$this->db2->from($this->table_name);
	$this->db2->join('main_wiring', 'checklist.main_wiring = main_wiring.id', 'left');
	$this->db2->join('plc', 'plc.id = main_wiring.plc', 'left');
	$this->db2->where($where);
	return $this->db2->get();
}
function get_by_tgl_user($tgl,$tgl2,$user){
	$select=array(
				'checklist.id',
				'main_wiring.devicetag',
				'main_wiring.description',
				'plc.brand',
				'plc.name',
				'checklist.user',
				'checklist.regulator',
				'checklist.keterangan',
				'checklist.label',
				'checklist.wrapping',
				'checklist.waktu',
				'checklist.tanggal'
			);
	$where=array(
			'checklist.tanggal >='=> $tgl,
			'checklist.tanggal <='=> $tgl2,
			'checklist.user' => $user
			);
	$this->db2->select($select);    
	$this->db2->from($this->table_name);
	$this->db2->join('main_wiring', 'checklist.main_wiring = main_wiring.id', 'left');
	$this->db2->join('plc', 'plc.id = main_wiring.plc', 'left');
	$this->db2->where($where);
	return $this->db2->get();
}
function get_by_last(){
	$select=array(
				'checklist.id',
				'main_wiring.devicetag',
				'main_wiring.description',
				'plc.brand',
				'plc.name',
				'checklist.user',
				'checklist.regulator',
				'checklist.keterangan',
				'checklist.label',
				'checklist.wrapping',
				'checklist.waktu',
				'checklist.tanggal'
			);
	$this->db2->select($select);    
	$this->db2->from($this->table_name);
	$this->db2->join('main_wiring', 'checklist.main_wiring = main_wiring.id', 'left');
	$this->db2->join('plc', 'plc.id = main_wiring.plc', 'left');
	$this->db2->order_by('id desc');
	$this->db2->limit(10);
	return $this->db2->get();
}
function get_search($keyword){
	$select=array(
				'checklist.id',
				'main_wiring.devicetag',
				'main_wiring.description',
				'plc.brand',
				'plc.name',
				'checklist.user',
				'checklist.regulator',
				'checklist.keterangan',
				'checklist.label',
				'checklist.wrapping',
				'checklist.waktu',
				'checklist.tanggal'
			);
	$this->db2->select($select);    
	$this->db2->from($this->table_name);
	$this->db2->join('main_wiring', 'checklist.main_wiring = main_wiring.id', 'left');
	$this->db2->join('plc', 'plc.id = main_wiring.plc', 'left');
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