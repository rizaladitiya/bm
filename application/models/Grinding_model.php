<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Grinding_model extends CI_Model {
	private $primary_key='id';
	private $table_name='grinding';
	private $grinding=array(
				'id',
				'customer',
				'date(date_start) as date_start',
				'date(date_finish) as date_finish',
				'location',
				'number',
				'before',
				'after',
				'face_length',
				'crowning',
				'material',
				'tolerance',
				'hardness',
				'surface',
				'roundness',
				'operator',
				'remark',
				'reported',
				'datetime',
				'delete'
			);
		private $grindingdata=array(
				'id',
				'id_grinding',
				'point',
				'before',
				'after'
			);
function __construct()
	{
		parent::__construct();
	}
function get_paged_list($limit=10,$offset=0,$order_column='',$order_type='asc'){
	if (empty($order_column)|| empty($order_type)){
		$where=array('delete'=>0);
		$this->db->where($where);
		$this->db->order_by($this->primary_key,'desc');
	}else{
		$where=array('delete'=>0);
		$this->db->where($where);
		$this->db->order_by($order_column,$order_type);
	}
	return $this->db->get($this->table_name,$limit,$offset);
}
function count_all() {
	$where=array('delete'=>0);
	$this->db->where($where);
	return $this->db->count_all($this->table_name);
}
function get_by_all(){
	$select=$this->grinding;
	$this->db->select($select);    
	$this->db->from($this->table_name);
	$where=array('delete'=>0);
	$this->db->where($where);
	$this->db->order_by('id desc');
	return $this->db->get();
}
function get_by_last(){
	$select=$this->grinding;
	$this->db->select($select);    
	$this->db->from($this->table_name);
	$this->db->limit(3, 0);
	$this->db->order_by('id desc');
	return $this->db->get();
}
function get_by_id($id){
	$select=$this->grinding;
	$this->db->select($select);    
	$this->db->from($this->table_name);
	$this->db->where($this->primary_key,$id);
	return $this->db->get();
}
function get_material_by_id($id){
	$select=array('id','nama','value');
	$this->db->select($select);    
	$this->db->from('grinding_material');
	$this->db->where($this->primary_key,$id);
	return $this->db->get();
}
function get_material_by_nama($nama){
	$select=array('id','nama','value');
	$this->db->select($select);    
	$this->db->from('grinding_material');
	$this->db->where('nama',$nama);
	return $this->db->get();
}
function get_material_all(){
	$select=array('id','nama','value');
	$this->db->select($select);    
	$this->db->from('grinding_material');
	return $this->db->get();
}
function get_child_by_parrent($id){
	$select=$this->grindingdata;
	$this->db->select($select);    
	$this->db->from('grinding_data');
	$this->db->where('id_grinding',$id);
	return $this->db->get();
}
function get_child_by_id($id){
	$select=$this->grindingdata;
	$this->db->select($select);    
	$this->db->from('grinding_data');
	$this->db->where($this->primary_key,$id);
	return $this->db->get();
}
function get_standard(){
	$select=array(
			'id',
			'point',
			'standard'
		);
	$this->db->select($select);    
	$this->db->from('grinding_master');
	return $this->db->get();
}

function add($data){
	$this->db->insert($this->table_name,$data);
	return $this->db->insert_id();
}
function add_point($datas,$id) {
	$data = array();
	$select=array(
			'id',
			'point',
			'standard'
		);
	$this->db->select($select);    
	$this->db->from('grinding_master');
	$i=0;
	foreach($this->db->get()->result() as $key){
		$data[] = array('id_grinding'=>$id,'point'=>$key->point,'before'=>$datas['before'][$i],'after'=>$datas['after'][$i]);
		$i++;
	}
	$this->db->insert_batch('grinding_data',$data);
}
function update($id,$data) {
	$this->db->where($this->primary_key,$id);
	$this->db->update($this->table_name,$data);
}

function delete($id) {
	$this->db->where($this->primary_key,$id);
	$this->db->update($this->table_name,array('delete'=>1));
	//$this->db->where($this->primary_key,$id);
	//$this->db->delete($this->table_name);
}
function delete_child_by_parrent($id) {
	$this->db->where('id_grinding',$id);
	$this->db->delete('grinding_data');
}
}
