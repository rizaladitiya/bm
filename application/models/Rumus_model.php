<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rumus_model extends CI_Model {
	private $primary_key='id';
	private $table_parrent='rumus';
	private $table_child='rumus_detail';
	private $semua=array(
				'rumus.id',
				'rumus.nama',
				'rumus.keterangan',
				'rumus_detail.id_rumus',
				'rumus_detail.simbol',
				'rumus_detail.nama as namarumus'
			);
	private $rumus=array(
				'rumus.id',
				'rumus.nama',
				'rumus.keterangan'
			);
	private $semuakemasan=array(
				'master_kemasan.id',
				'master_kemasan.nama',
				'master_kemasan.keterangan',
				'master_kemasan.id_rumus',
				'master_kemasan.delete',
				'master_kemasan_detail.id_master_kemasan',
				'master_kemasan_detail.value'
			);
	private $kemasan=array(
				'master_kemasan.id',
				'master_kemasan.nama',
				'master_kemasan.keterangan',
				'master_kemasan.id_rumus',
				'master_kemasan.id_rumus'
			);
	
function __construct()
	{
		parent::__construct();
	}
function count_all() {
	return $this->db->count_all($this->table_parrent);
}
function get_by_all(){
	$select=$semua;
	$this->db->select($select);    
	$this->db->from($this->table_parrent);
	$this->db->order_by('id desc');
	return $this->db->get();
}
function get_rumus($id){
	$where=array(
			'rumus.id'=> $id
			);
	$select=$this->semua;
	$this->db->select($select);    
	$this->db->from($this->table_parrent);
	$this->db->join($this->table_child, 'rumus.id = rumus_detail.id_rumus', 'inner');
	$this->db->where($where);
	return $this->db->get();
}
function get_rumus_group(){
	$select=$this->rumus;
	$this->db->select($select);    
	$this->db->from($this->table_parrent);
	return $this->db->get();
}
function get_kemasan($id){
	$where=array(
			'master_kemasan.id'=> $id
			);
	$select=$this->semuakemasan;
	$this->db->select($select);    
	$this->db->from('master_kemasan');
	$this->db->join('master_kemasan_detail', 'master_kemasan.id = master_kemasan_detail.id_master_kemasan', 'inner');
	$this->db->where($where);
	return $this->db->get();
}
function get_kemasan_all(){
	$select=$this->semuakemasan;
	$this->db->select($select);    
	$this->db->from('master_kemasan');
	$this->db->join('master_kemasan_detail', 'master_kemasan.id = master_kemasan_detail.id_master_kemasan', 'inner');
	$where=array('delete'=>0);
	$this->db->where($where);
	return $this->db->get();
}

function count_kemasan() {
	$select=$this->kemasan;
	$this->db->select($select);    
	$this->db->from('master_kemasan');
	$where=array('delete'=>0);
	$this->db->where($where);
	return $this->db->count_all();
}

function get_kemasan_group(){
	$select=$this->kemasan;
	$this->db->select($select);    
	$this->db->from('master_kemasan');
	$where=array('delete'=>0);
	$this->db->where($where);
	$this->db->order_by('nama asc');
	return $this->db->get();
}

function get_paged_list($limit=10,$offset=0,$order_column='',$order_type='asc'){
	if (empty($order_column)|| empty($order_type))
		$this->db->order_by('master_kemasan.nama','asc');
	else
		$this->db->order_by($order_column,$order_type);
	$select=$this->kemasan;
	$this->db->select($select);    
	$this->db->from('master_kemasan');
	$where=array('delete'=>0);
	$this->db->where($where);
	$this->db->limit($limit,$offset);
	return $this->db->get();
}

function get_by_id($id){
	$select=$semua;
	$this->db->select($select);    
	$this->db->from($this->table_parrent);
	$this->db->where($this->primary_key,$id);
	return $this->db->get();
}

function add_kemasan($data){
	$this->db->insert('master_kemasan',$data);
	return $this->db->insert_id();
}
function add_kemasan_point($datas,$id) {
	$data = array();
	foreach($datas as $key){
		$data[] = array('id_master_kemasan'=>$id,'value'=>$key);
	}
	$this->db->insert_batch('master_kemasan_detail',$data);
}
function update($id,$data) {
	$this->db->where($this->primary_key,$id);
	$this->db->update($this->table_parrent,$data);
}
function update_kemasan($id,$data) {
	$this->db->where($this->primary_key,$id);
	$this->db->update('master_kemasan',$data);
}
function delete($id) {
	$this->db->where($this->primary_key,$id);
	$this->db->delete($this->table_parrent);
}
function delete_child_by_parrent($id) {
	$this->db->where('id_master_kemasan',$id);
	$this->db->delete('master_kemasan_detail');
}
}
