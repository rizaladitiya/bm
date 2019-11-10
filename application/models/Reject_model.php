<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reject_model extends CI_Model {
	private $primary_key='id';
	private $table_name='roll_reject';
function __construct()
	{
		parent::__construct();
	}
function get_paged_list($limit=10,$offset=0,$order_column='',$order_type='asc'){
	if (empty($order_column)|| empty($order_type))
	$this->db->order_by($this->primary_key,'desc');
	else
	$this->db->order_by($order_column,$order_type);
	return $this->db->get($this->table_name,$limit,$offset);
}
function count_all() {
	return $this->db->count_all($this->table_name);
}
function get_by_all(){
	$select=array(
				$this->primary_key,
				'datetime',
				'datetime2',
				'roll',
				'pm',
				'jenis',
				'gsm',
				'lebar',
				'berat',
				'warna',
				'keterangan',
				'stock',
				'stock2'
			);
	$this->db->select($select);    
	$this->db->from($this->table_name);
	$this->db->order_by('id desc');
	return $this->db->get();
}
function get_by_stock(){
	$select=array(
				$this->primary_key,
				'datetime',
				'datetime2',
				'roll',
				'pm',
				'jenis',
				'gsm',
				'lebar',
				'berat',
				'warna',
				'keterangan',
				'stock',
				'stock2'
			);
	$where=array(
				'stock'=>1,
				'stock2'=>1
		);
	$this->db->select($select);    
	$this->db->from($this->table_name);
	$this->db->where($where);
	$this->db->order_by('datetime asc,jenis asc,gsm asc,lebar asc');
	return $this->db->get();
}
function get_by_stock_tgl($tgl,$tgl2){
	$select=array(
				$this->primary_key,
				'datetime',
				'datetime2',
				'roll',
				'pm',
				'jenis',
				'gsm',
				'lebar',
				'berat',
				'warna',
				'keterangan',
				'stock',
				'stock2'
			);
	$this->db->where('stock',1);
	$this->db->where('stock2',1);
	if(!empty($tgl) && !empty($tgl2)){
		$from=date('Y-m-d',strtotime($tgl));
		$to=date('Y-m-d',strtotime($tgl2));
		$this->db->where('date(datetime)>=',$from);
		$this->db->where('date(datetime)<=',$to);
	}
	if(!empty($tgl) && empty($tgl2)){
		$from=date('Y-m-d',strtotime($tgl));
		$this->db->where('date(datetime)',$from);
	}
	$this->db->select($select);    
	$this->db->from($this->table_name);
	$this->db->order_by('datetime asc,jenis asc,gsm asc,lebar asc');
	return $this->db->get();
}
function get_by_kirim_tgl($tgl,$tgl2){
	$select=array(
				$this->primary_key,
				'tanggal',
				'datetime',
				'customer',
				'po',
				'kendaraan',
				'keterangan'  
			);
	if(!empty($tgl) && !empty($tgl2)){
		$from=date('Y-m-d',strtotime($tgl));
		$to=date('Y-m-d',strtotime($tgl2));
		$this->db->where('tanggal>=',$from);
		$this->db->where('tanggal<=',$to);
	}
	if(!empty($tgl) && empty($tgl2)){
		$from=date('Y-m-d',strtotime($tgl));
		$this->db->where('tanggal',$from);
	}
	if(empty($tgl) && empty($tgl2)){
		$from=date('Y-m-d');
		$this->db->where('tanggal',$from);
	}
	$this->db->select($select);    
	$this->db->from('kirim_reject');
	$this->db->order_by('datetime asc');
	return $this->db->get();
}
function get_by_last(){
	$select=array(
				$this->primary_key,
				'datetime',
				'datetime2',
				'roll',
				'pm',
				'jenis',
				'gsm',
				'lebar',
				'berat',
				'warna',
				'keterangan',
				'stock',
				'stock2'
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
				'roll',
				'pm',
				'jenis',
				'gsm',
				'lebar',
				'berat',
				'warna',
				'keterangan',
				'stock',
				'stock2'
			);
	$this->db->select($select);    
	$this->db->from($this->table_name);
	$this->db->where($this->primary_key,$id);
	return $this->db->get();
}
function get_by_kirim($id){
	$select=array(
			'id',
			'tanggal',
			'datetime',
			'customer',
			'po',
			'kendaraan',
			'keterangan'  
		);
	$where = array(
		'id'=>$id
		);
	$this->db->select($select);    
	$this->db->from('kirim_reject');
	$this->db->where($where);
	return $this->db->get();
}
function get_by_kirimdetail($id){
	$select=array(
				$this->primary_key,
				'datetime',
				'datetime2',
				'roll',
				'pm',
				'jenis',
				'gsm',
				'lebar',
				'berat',
				'warna',
				'keterangan',
				'stock',
				'stock2'
			);
	$this->db->select($select);    
	$this->db->from($this->table_name);
	$this->db->where('kirim',$id);
	return $this->db->get();
}
function addkirim($data){
	$this->db->insert('kirim_reject',$data);
	return $this->db->insert_id();
}
function tandaikirim($id,$roll) {
	$this->db->where_in('id',$roll);
	$this->db->update($this->table_name,array('kirim'=>$id));
}
function hapusstock($roll) {
	$this->db->where_in('id',$roll);
	$this->db->update($this->table_name,array('stock'=>0));
}
function hapusstock2($roll) {
	$this->db->where_in('id',$roll);
	$this->db->update($this->table_name,array('stock2'=>0));
}
function updatekirim($id,$data) {
	$this->db->where($this->primary_key,$id);
	$this->db->update('kirim_reject',$data);
}
function add($data){
	$this->db->insert($this->table_name,$data);
	return $this->db->insert_id();
}
function update($id,$data) {
	$this->db->where($this->primary_key,$id);
	$this->db->update($this->table_name,$data);
}

function delete($id) {
	$this->db->where($this->primary_key,$id);
	$this->db->delete($this->table_name);
}
}
