<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tmpgrupbarang_model extends CI_Model {
	private $primary_key='id';
	private $table_name='tmpgrupbarang';
function __construct()
	{
		parent::__construct();
	}
function count_all() {
	return $this->db->count_all($this->table_name);
}
function get_by_all(){
	$select=array(
				$this->primary_key,
				'tanggal',
				'pm',
				'jenis',
				'gsm',
				'lebar',
				'warna',
				'jumlah',
				'ambil'
			);
	$this->db->select($select);    
	$this->db->from($this->table_name);
	$this->db->order_by('id desc');
	return $this->db->get();
}
function get_by_last(){
	$select=array(
				$this->primary_key,
				'tanggal',
				'pm',
				'jenis',
				'gsm',
				'lebar',
				'warna',
				'jumlah',
				'ambil'
			);
	$this->db->select($select);    
	$this->db->from($this->table_name);
	$this->db->limit(5, 0);
	$this->db->order_by('id desc');
	return $this->db->get();
}
function get_by_id($id){
	$select=array(
				$this->primary_key,
				'tanggal',
				'pm',
				'jenis',
				'gsm',
				'lebar',
				'warna',
				'jumlah',
				'ambil'
			);
	$this->db->select($select);    
	$this->db->from($this->table_name);
	$this->db->where($this->primary_key,$id);
	return $this->db->get();
}
function get_by_plan($pm=0,$jenis,$gsm,$lebar,$warna){
	$where=array(
			'tmpgrupbarang.jenis'=> $jenis,
			'tmpgrupbarang.gsm'=> $gsm,
			'tmpgrupbarang.lebar'=> $lebar,
			'tmpgrupbarang.warna'=> $warna,
			'tmpgrupbarang.pm'=>$pm
			);
	
	$select=array(
				$this->primary_key,
				'tanggal',
				'pm',
				'jenis',
				'gsm',
				'lebar',
				'warna',
				'jumlah',
				'ambil'
			);
	$this->db->select($select);    
	$this->db->from($this->table_name);
	$this->db->where($where);
	return $this->db->get();
}
function get_by_estimasi($pm=0,$jenis,$gsm,$lebar,$warna){
	$where=array(
			'tmpgrupbarang.jenis'=> $jenis,
			'tmpgrupbarang.gsm'=> $gsm,
			'tmpgrupbarang.lebar'=>$lebar,
			'tmpgrupbarang.warna'=> $warna
			);
	if($pm!=0){
		$where = $where + array('tmpgrupbarang.pm'=>$pm);	
	}
	$select=array(
				$this->primary_key,
				'pm',
				'jenis',
				'gsm',
				'warna',
				'jumlah',
				'ambil'
			);
	$this->db->select($select);    
	$this->db->from('tmpgrupbarang');
	$this->db->where($where);
	return $this->db->get();
}
function get_by_pm($pm){
	$select=array(
				'pm',
				'jenis',
				'gsm',
				'lebar',
				'warna',
				'jumlah',
				'ambil'
			);
	$where=array(
			'tmpgrupbarang.pm'=> $pm
			);
	$this->db->select($select);    
	$this->db->from($this->table_name);
	$this->db->where($where);
	$this->db->group_by('pm,jenis,gsm,lebar,warna'); 
	$this->db->order_by('id desc');
	return $this->db->get();
}
function add($data){
	$this->db->insert($this->table_name,$data);
	return $this->db->insert_id();
}
function add_batch($data){
	$this->db->truncate($this->table_name);
	$this->db->insert_batch($this->table_name, $data);
}
function update($id,$data) {
	$this->db->where($this->primary_key,$id);
	$this->db->update($this->table_name,$data);
}
function delete($id) {
	$this->db->where($this->primary_key,$id);
	$this->db->delete($this->table_name);
}
function updatetmpgrupbarangberat($id,$berat) {
	$this->db->where($this->primary_key,$id);
	$data = array('ambil' => $berat);
	$this->db->update($this->table_name,$data);
}
}
