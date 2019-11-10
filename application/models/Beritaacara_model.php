<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Beritaacara_model extends CI_Model {
	private $primary_key='id';
	private $table_name='telat_input';
	private $table_masalah='telat_input_masalah';
function __construct()
	{
		parent::__construct();
	}
function get_paged_list($limit=10,$offset=0,$order_column='id',$order_type='desc'){
	if (empty($order_column)|| empty($order_type))
	//$this->db->order_by($this->primary_key,'desc');
	$this->db->order_by('id desc');
	else
	$this->db->order_by($order_column,$order_type);
	return $this->db->get($this->table_name,$limit,$offset);
}
function get_cetak_paged_list($limit=10,$offset=0,$order_column='',$order_type='asc'){
	if (empty($order_column)|| empty($order_type))
	$this->db->order_by($this->primary_key,'desc');
	else
	$this->db->order_by($order_column,$order_type);
	return $this->db->get('telat_input_cetak',$limit,$offset);
}
function count_all() {
	return $this->db->count_all($this->table_name);
}
function count_all_viewcetak() {
	return $this->db->count_all('telat_input_cetak');
}
function get_by_all(){
	$select=array(
				$this->primary_key,
				'datetime',
				'datetime2',
				'no_jumbo',
				'no_roll',
				'jenis',
				'gsm',
				'lebar',
				'gsm_2',
				'lebar_2',
				'diameter',
				'berat',
				'mutu',
				'keterangan',
				'rct',
				'bst',
				'cobb',
				'smooth',
				'pm',
				'putus',
				'warna',
				'shift',
				'kepala',
				'upload',
				'src',
				'export',
				'cetak'
			);
	$this->db->select($select);    
	$this->db->from($this->table_name);
	$this->db->order_by('id desc');
	return $this->db->get();
}
function get_by_all_noprint_noupload(){
	$where = array(
		'cetak'=>0,
		'upload'=>0
		);
	$select=array(
				$this->primary_key,
				'datetime',
				'datetime2',
				'no_jumbo',
				'no_roll',
				'jenis',
				'gsm',
				'lebar',
				'gsm_2',
				'lebar_2',
				'diameter',
				'berat',
				'mutu',
				'keterangan',
				'rct',
				'bst',
				'cobb',
				'smooth',
				'pm',
				'putus',
				'warna',
				'shift',
				'kepala',
				'upload',
				'src',
				'export',
				'cetak'
			);
	$this->db->select($select);    
	$this->db->from($this->table_name);
	$this->db->where($where);
	$this->db->order_by('id desc');
	return $this->db->get();
}
function get_by_all_noupload(){
	$where = array(
		'upload'=>0
		);
	$select=array(
				$this->primary_key,
				'datetime',
				'datetime2',
				'no_jumbo',
				'no_roll',
				'jenis',
				'gsm',
				'lebar',
				'gsm_2',
				'lebar_2',
				'diameter',
				'berat',
				'mutu',
				'keterangan',
				'rct',
				'bst',
				'cobb',
				'smooth',
				'pm',
				'putus',
				'warna',
				'shift',
				'kepala',
				'upload',
				'src',
				'export',
				'cetak'
			);
	$this->db->select($select);    
	$this->db->from($this->table_name);
	$this->db->where($where);
	$this->db->order_by('id desc');
	return $this->db->get();
}
function get_by_print($id){
	$select=array(
			'id',
			'tanggal',
			'tanggal_input',
			'alasan',
			'pm',
			'masalah' 
		);
	$where = array(
		'id'=>$id
		);
	$this->db->select($select);    
	$this->db->from('telat_input_cetak');
	$this->db->where($where);
	return $this->db->get();
	}
function get_by_print_detail($id){
	$select=array(
				$this->primary_key,
				'datetime',
				'datetime2',
				'no_jumbo',
				'no_roll',
				'jenis',
				'gsm',
				'lebar',
				'gsm_2',
				'lebar_2',
				'diameter',
				'berat',
				'mutu',
				'keterangan',
				'rct',
				'bst',
				'cobb',
				'smooth',
				'pm',
				'putus',
				'warna',
				'shift',
				'kepala',
				'upload',
				'src',
				'export',
				'cetak'
			);
	$this->db->select($select);    
	$this->db->from($this->table_name);
	$this->db->where('cetak',$id);
	$this->db->order_by('no_roll asc');
	return $this->db->get();
	}
function get_by_blmcetak($pm){
	$select=array(
				$this->primary_key,
				'datetime',
				'datetime2',
				'no_jumbo',
				'no_roll',
				'jenis',
				'gsm',
				'lebar',
				'gsm_2',
				'lebar_2',
				'diameter',
				'berat',
				'mutu',
				'keterangan',
				'rct',
				'bst',
				'cobb',
				'smooth',
				'pm',
				'putus',
				'warna',
				'shift',
				'kepala',
				'upload',
				'src',
				'export',
				'cetak'
			);
	$where=array(
			'cetak'=>0,
			'upload'=>0
			);
	if($pm!=0){
		$where = $where + array('pm'=>$pm);	
	}
	$this->db->select($select);    
	$this->db->from($this->table_name);
	$this->db->where($where);
	$this->db->order_by('datetime asc,jenis,gsm,lebar');
	return $this->db->get();
}
function get_by_blmupload(){
	$select=array(
				$this->primary_key,
				'datetime',
				'datetime2',
				'no_jumbo',
				'no_roll',
				'jenis',
				'gsm',
				'lebar',
				'gsm_2',
				'lebar_2',
				'diameter',
				'berat',
				'mutu',
				'keterangan',
				'rct',
				'bst',
				'cobb',
				'smooth',
				'pm',
				'putus',
				'warna',
				'shift',
				'kepala',
				'upload',
				'src',
				'export',
				'cetak'
			);
	$where=array(
			'upload'=>0
			);
	if($pm!=0){
		$where = $where + array('pm'=>$pm);	
	}
	$this->db->select($select);    
	$this->db->from($this->table_name);
	$this->db->where($where);
	$this->db->order_by('jenis,gsm,lebar');
	return $this->db->get();
}
function get_by_last(){
	$select=array(
				'id',
				'date_start',
				'date_finish',
				'location',
				'number',
				'before',
				'after',
				'face_length',
				'crowning',
				'material',
				'hardness',
				'surface',
				'roundness',
				'operator',
				'remark',
				'reported',
				'datetime',
				'close'
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
				'datetime',
				'datetime2',
				'no_jumbo',
				'no_roll',
				'jenis',
				'gsm',
				'lebar',
				'gsm_2',
				'lebar_2',
				'diameter',
				'berat',
				'mutu',
				'keterangan',
				'rct',
				'bst',
				'cobb',
				'smooth',
				'pm',
				'putus',
				'warna',
				'shift',
				'kepala',
				'upload',
				'src',
				'export',
				'cetak'
			);
	$this->db->select($select);    
	$this->db->from($this->table_name);
	$this->db->where($this->primary_key,$id);
	return $this->db->get();
}
function get_by_masalah($id){
	$data=array();
	$select=array(
				'masalah'
			);
	$this->db->select($select);    
	$this->db->from($this->table_masalah);
	$this->db->where('id_telat_input',$id);
	foreach($this->db->get()->result() as $input_type) {
    	$data[] = $input_type->masalah;
	}
	return $data;
}
function get_by_masalah2($id,$masalah){
	$data=array();
	$select=array(
				'masalah'
			);
	$this->db->select($select);    
	$this->db->from($this->table_masalah);
	$this->db->where(array('id_telat_input'=>$id,'masalah'=>$masalah));
	return $this->db->get();
}
function add($data){
	$this->db->insert($this->table_name,$data);
	return $this->db->insert_id();
}
function addprint($data){
	$this->db->insert('telat_input_cetak',$data);
	return $this->db->insert_id();
}
function updateprint($id,$data) {
	$this->db->where($this->primary_key,$id);
	$this->db->update('telat_input_cetak',$data);
}
function update($id,$data) {
	$this->db->where($this->primary_key,$id);
	$this->db->update($this->table_name,$data);
}
function tandaiprint($id,$roll) {
	$this->db->where_in('id',$roll);
	$this->db->update($this->table_name,array('cetak'=>$id));
}
function add_masalah($datas,$id) {
	$data = array();
	foreach($datas as $data2){
		$data[] = array('masalah'=>$data2,'id_telat_input'=>$id);
	}
	$this->db->insert_batch($this->table_masalah,$data);
}
function delete($id) {
	$this->db->where($this->primary_key,$id);
	$this->db->delete($this->table_name);
}
function deletecetak($id) {
	$this->db->where($this->primary_key,$id);
	$this->db->delete("telat_input_cetak");
	$this->db->where("cetak",$id);
	$this->db->delete($this->table_name);
}
function delete_masalah_by_telat($id) {
	$this->db->where('id_telat_input',$id);
	$this->db->delete($this->table_masalah);
}
}
