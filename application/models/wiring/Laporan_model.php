<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Laporan_model extends CI_Model {
		private $db2;
 		private $primary_key='id';
		private $table_name='laporan';

 public function __construct()
 {
  parent::__construct();
        $this->db2 = $this->load->database('wiring', TRUE);
 }
 function get_by_all(){
	$select=array(
				'laporan.id',
				'laporan.masalah',
				'laporan.tindakan',
				'laporan.koreksi',
				'laporan.keterangan',
				'laporan.main_wiring',
				'laporan.tanggal',
				'laporan.dari',
				'laporan.hingga',
				'laporan.user'
			);
	$this->db2->select();  
	$this->db2->from($this->table_name);
	$this->db2->join('main_wiring', 'laporan.main_wiring = main_wiring.id', 'left');
	$this->db2->order_by('id asc');
	return $this->db2->get();
}
function get_by_id($id){
	$select=array(
				'laporan.id',
				'laporan.masalah',
				'laporan.tindakan',
				'laporan.koreksi',
				'laporan.keterangan',
				'laporan.main_wiring',
				'laporan.tanggal',
				'laporan.dari',
				'laporan.hingga',
				'laporan.user'
			);
	$this->db2->select($select);    
	$this->db2->from($this->table_name);
	$this->db2->join('main_wiring', 'laporan.main_wiring = main_wiring.id', 'left');
	$this->db2->where('id',$id);
	return $this->db2->get();
}
function get_by_tgl($tgl,$tgl2){
	$select=array(
				'laporan.id',
				'laporan.masalah',
				'laporan.tindakan',
				'laporan.koreksi',
				'laporan.keterangan',
				'laporan.main_wiring',
				'laporan.tanggal',
				'laporan.dari',
				'laporan.hingga',
				'laporan.user'
			);
	$where=array(
			'laporan.tanggal >='=> $tgl,
			'laporan.tanggal <='=> $tgl2
			);
	$this->db2->select($select);    
	$this->db2->from($this->table_name);
	$this->db2->join('main_wiring', 'laporan.main_wiring = main_wiring.id', 'left');
	$this->db2->where($where);
	return $this->db2->get();
}
function get_by_tgl_user($tgl,$tgl2,$user){
	$select=array(
				'laporan.id',
				'laporan.masalah',
				'laporan.tindakan',
				'laporan.koreksi',
				'laporan.keterangan',
				'laporan.main_wiring',
				'laporan.tanggal',
				'laporan.dari',
				'laporan.hingga',
				'laporan.user'
			);
	$where=array(
			'laporan.tanggal >='=> $tgl,
			'laporan.tanggal <='=> $tgl2,
			'laporan.user' => $user
			);
	$this->db2->select($select);    
	$this->db2->from($this->table_name);
	$this->db2->join('main_wiring', 'laporan.main_wiring = main_wiring.id', 'left');
	$this->db2->join('plc', 'plc.id = main_wiring.plc', 'left');
	$this->db2->where($where);
	return $this->db2->get();
}
function get_by_last(){
	$select=array(
				'laporan.id',
				'laporan.masalah',
				'laporan.tindakan',
				'laporan.koreksi',
				'laporan.keterangan',
				'laporan.main_wiring',
				'laporan.tanggal',
				'laporan.dari',
				'laporan.hingga',
				'laporan.user'
			);
	$this->db2->select($select);    
	$this->db2->from($this->table_name);
	$this->db2->join('main_wiring', 'laporan.main_wiring = main_wiring.id', 'left');
	$this->db2->order_by('id desc');
	$this->db2->limit(10);
	return $this->db2->get();
}
function get_search($keyword){
	$select=array(
				'laporan.id',
				'laporan.masalah',
				'laporan.tindakan',
				'laporan.koreksi',
				'laporan.keterangan',
				'laporan.main_wiring',
				'laporan.tanggal',
				'laporan.dari',
				'laporan.hingga',
				'laporan.user'
			);
	$this->db2->select($select);    
	$this->db2->from($this->table_name);
	$this->db2->join('main_wiring', 'laporan.main_wiring = main_wiring.id', 'left');
	$this->db2->like('laporan.masalah',$keyword);
	$this->db2->or_like('laporan.tindakan', $keyword);
	$this->db2->or_like('laporan.koreksi', $keyword);
	$this->db2->order_by('laporan.tanggal asc');
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