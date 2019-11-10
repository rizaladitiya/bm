<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Plan_model extends CI_Model {

	private $primary_key='id';
	private $table_name='plan';
	private $masterharga='plan_harga';
	

function get_paged_list($limit=10,$offset=0,$order_column='',$order_type='asc'){
	if (empty($order_column)|| empty($order_type))
	$this->db->order_by($this->primary_key,'asc');
	else
	$this->db->order_by($order_column,$order_type);
	return $this->db->get($this->table_name,$limit,$offset);
}
function count_all() {
	return $this->db->count_all($this->table_name);
}
function get_group_tanggal($tgl) {
	$where=array(
			'plan.tanggal'=> $tgl
			);
	$select=array(
				'group_concat(plan_detail.jenis) as jenis',
				'0 as pm',
				'group_concat(plan_detail.gsm) as gsm',
				'group_concat(plan_detail.lebar) as lebar'
			);
	$this->db->select($select);    
	$this->db->from('plan');
	$this->db->join('plan_detail', 'plan.id = plan_detail.plan_id', 'inner');
	$this->db->where($where);
	return $this->db->get();
}
function get_masterharga() {
	$this->db->order_by('nama asc');
	return $this->db->get($this->masterharga);
}
function get_harga_id($id) {
	
	$select=array(
				'nama'
			);
	$this->db->where($this->primary_key,$id);
	return $this->db->get($this->masterharga);
}
function get_group_blmtutup() {
	$where=array(
			'plan.tutup'=> 0
			);
	$select=array(
				'group_concat(plan_detail.jenis) as jenis',
				'0 as pm',
				'group_concat(plan_detail.gsm) as gsm',
				'group_concat(plan_detail.lebar) as lebar'
			);
	$this->db->select($select);    
	$this->db->from('plan');
	$this->db->join('plan_detail', 'plan.id = plan_detail.plan_id', 'inner');
	$this->db->where($where);
	return $this->db->get();
}
function close_expired() {
	$data = $this->get_by_expired()->result_array();
	if(!empty($data)){
	$ids = array();
	foreach ($data as $id)
    {
        $ids[] = $id['id'];
    }
	$this->db->where_in('id', $ids);
	$this->db->update('plan', array('tutup'=>1,'tutup_status'=>'Expired'));
	}
}
function get_by_expired(){
	$where=array(
			'datediff(date(now()), tanggal)>='=>2,
			'tutup'=>0,
			'lanjut'=>0
			);
	$select=array(
				'plan.id'
			);
	$this->db->select($select);    
	$this->db->from('plan');
	$this->db->where($where);
	return $this->db->get();
}
function get_by_id($id){
	$where=array(
			'plan.id'=> $id
			);
	$select=array(
				'plan.id',
				'plan.tanggal',
				'plan.prioritas',
				'plan.truck',
				'plan.pm',
				'plan.pm_hasil',
				'plan.customer_id',
				'plan.customer_nama',
				'plan.proses',
				'plan.tutup_status',
				'plan.lanjut',
				'plan.tutup'
			);
	$this->db->select($select);    
	$this->db->from('plan');
	$this->db->where($where);
	return $this->db->get();
}
function get_by_tgl($tgl,$tgl2){
	$where=array(
			'plan.tanggal >='=> $tgl,
			'plan.tanggal <='=> $tgl2
			);
	$select=array(
				'plan.id',
				'plan.tanggal',
				'plan.prioritas',
				'plan.truck',
				'plan.pm',
				'plan.pm_hasil',
				'plan.customer_id',
				'plan.customer_nama',
				'plan.proses',
				'plan.tutup_status',
				'plan.lanjut',
				'plan.tutup'
			);
	$this->db->select($select);    
	$this->db->from('plan');
	$this->db->where($where);
	return $this->db->get();
}
function get_by_tgl_pm($tgl,$tgl2,$pm){
	
	$where=array(
			'plan.tanggal >='=> $tgl,
			'plan.tanggal <='=> $tgl2
			);
	
	if($pm!=0){
		$where = $where + array('plan.pm'=>$pm);	
	}
	$select=array(
				'plan.id',
				'plan.tanggal',
				'plan.prioritas',
				'plan.truck',
				'plan.pm',
				'plan.pm_hasil',
				'plan.customer_id',
				'plan.customer_nama',
				'plan.proses',
				'plan.tutup_status',
				'plan.lanjut',
				'plan.tutup'
			);
	$this->db->select($select);    
	$this->db->from('plan');
	$this->db->where($where);
	return $this->db->get();
}
function get_by_blmtutup(){
	$where=array(
			'plan.tutup'=> 0
			);
	$select=array(
				'plan.id',
				'plan.tanggal',
				'plan.prioritas',
				'plan.truck',
				'plan.pm',
				'plan.pm_hasil',
				'plan.customer_id',
				'plan.customer_nama',
				'plan.proses',
				'plan.tutup_status',
				'plan.lanjut',
				'plan.tutup'
			);
	$this->db->select($select);    
	$this->db->from('plan');
	$this->db->where($where);
	return $this->db->get();
}
function get_by_lap($tgl,$tgl2,$pm=0,$status){
	$where=array(
			'plan.tanggal >='=> $tgl,
			'plan.tanggal <='=> $tgl2,
			'plan.tutup'=> $status
			);
	if($pm!=0){
		$where = $where + array('plan.pm'=>$pm);	
	}
	$select=array(
				'plan.tanggal',
				'plan.prioritas',
				'plan.truck',
				'plan.pm',
				'plan.pm_hasil',
				'plan.customer_id',
				'plan.customer_nama',
				'plan.lanjut',
				'plan.tutup',
				'plan.proses',
				'plan.tutup_status',
				'plan_detail.id',
				'plan_detail.plan_id',
				'plan_detail.po_id',
				'plan_detail.po',
				'plan_detail.po_detail_id',
				'plan_detail.jenis',
				'plan_detail.gsm',
				'plan_detail.lebar',
				'plan_detail.jumlah',
				'plan_detail.sisa1 as q1',
				'plan_detail.sisa2 as q2',
				'plan_detail.sisa3 as q3',
				'plan_detail.sisa4 as q4',
				'plan_detail.barang'
			);
	$this->db->select($select);    
	$this->db->from('plan');
	$this->db->join('plan_detail', 'plan.id = plan_detail.plan_id', 'inner');
	$this->db->where($where);
	$this->db->order_by('plan.tanggal asc,plan.id asc,plan.customer_nama asc');
	return $this->db->get();
}
function get_by_lap_email($tgl,$tgl2,$pm){
	$where=array(
			'plan.tanggal >='=> $tgl,
			'plan.tanggal <='=> $tgl2,
			'plan.pm'=>$pm
			);
	$select=array(
				'plan.tanggal',
				'plan.prioritas',
				'plan.pm',
				'plan.pm_hasil',
				'plan.customer_id',
				'plan.customer_nama',
				'plan_detail.id',
				'plan_detail.plan_id',
				'plan_detail.po_id',
				'plan_detail.po',
				'plan_detail.po_detail_id',
				'plan_detail.jenis',
				'plan_detail.gsm',
				'plan_detail.lebar',
				'plan_detail.jumlah',
				'plan_detail.barang'
			);
	$this->db->select($select);    
	$this->db->from('plan');
	$this->db->join('plan_detail', 'plan.id = plan_detail.plan_id', 'inner');
	$this->db->where($where);
	$this->db->order_by('plan.tanggal asc,plan.id asc,plan.customer_nama asc');
	return $this->db->get();
}
function get_group_by_lap($tgl,$tgl2,$pm){
	$where=array(
			'plan.tanggal >='=> $tgl,
			'plan.tanggal <='=> $tgl2,
			'plan.pm_hasil'=>$pm
			);
	$select=array(
				'plan.tanggal',
				'plan.pm',
				'plan.pm_hasil',
				'plan_detail.jenis',
				'plan_detail.gsm',
				'plan_detail.lebar',
				'plan_detail.warna',
				'sum(plan_detail.jumlah) as jumlah',
				'plan_detail.barang',
				'plan_detail.po_id',
				'plan_detail.po',
				'plan.customer_nama'
			);
	$this->db->select($select);    
	$this->db->from('plan');
	$this->db->join('plan_detail', 'plan.id = plan_detail.plan_id', 'inner');
	$this->db->where($where);
	$this->db->order_by('plan.tanggal asc,plan.prioritas asc,plan_detail.jenis asc,plan_detail.gsm asc,plan_detail.lebar asc,plan_detail.warna asc');
	$this->db->group_by('plan.pm,plan_detail.jenis,plan_detail.gsm,plan_detail.lebar');
	
	return $this->db->get();
}
function get_by_kitir($tanggal){
	$where=array(
			'plan.tanggal <=' => $tanggal,
			'plan.tutup'=>0
			);
	$select=array(
				'plan.tanggal',
				'plan.prioritas',
				'plan.truck',
				'plan.pm',
				'plan.pm_hasil',
				'plan.customer_id',
				'plan.lanjut',
				'plan.tutup',
				'plan.proses',
				'plan.tutup_status',
				'plan_detail.id',
				'plan_detail.plan_id',
				'plan_detail.po_id',
				'plan_detail.po_detail_id',
				'plan_detail.jenis',
				'plan_detail.gsm',
				'plan_detail.lebar',
				'plan_detail.jumlah',
				'plan_detail.sisa1 as sisa1',
				'plan_detail.sisa2 as sisa2',
				'plan_detail.sisa3 as sisa3',
				'plan_detail.sisa4 as sisa4',
				'(plan_detail.q1*plan_detail.jumlah/100) as q1',
				'(plan_detail.q2*plan_detail.jumlah/100) as q2',
				'(plan_detail.q3*plan_detail.jumlah/100) as q3',
				'(plan_detail.q4*plan_detail.jumlah/100) as q4',
				'plan_detail.barang'
			);
	$this->db->select($select);    
	$this->db->from('plan');
	$this->db->join('plan_detail', 'plan.id = plan_detail.plan_id', 'inner');
	$this->db->where($where);
	$this->db->order_by('tanggal asc,prioritas asc');
	return $this->db->get();
}
function get_by_mutu($pm,$jenis,$gsm,$lebar,$mutu){
	$where=array(
			'mutu'=>$mutu,
			'jenis'=>$jenis,
			'gsm'=>$gsm,
			'lebar'=>$lebar,
			'plan_detail'=>0
			);
	if($pm!=0){
		$where = $where + array('pm'=>$pm);	
	}
	$select=array(
				'id',
				'barang_id',
				'berat',
				'kode_roll'
			);
	$this->db->select($select);    
	$this->db->from('plan_barang');
	$this->db->where($where);
	$this->db->order_by('kode_roll','asc');
	return $this->db->get();
}
function get_prepare_roll($id){
	$where=array(
			'plan_detail'=>$id
			);
	$select=array(
				'plan_barang.id',
				'plan_barang.barang_id',
				'plan_barang.berat',
				'plan_barang.kode_roll',
				'plan_detail.po_detail_id',
				'plan.truck',
				'plan.tanggal'
			);
	$this->db->select($select);    
	$this->db->from('plan_barang');
	$this->db->join('plan_detail', 'plan_barang.plan_detail = plan_detail.id', 'inner');
	$this->db->join('plan', 'plan.id = plan_detail.plan_id', 'inner');
	$this->db->where($where);
	return $this->db->get();
}
function get_prepare_send($id){
	$where=array(
			'plan.id'=>$id
			);
	$select=array(
				'plan_detail.po_id',
				'plan_detail.po_detail_id',
				'plan.tanggal',
				'plan_detail.plan_id',
				'plan.truck',
				'plan_detail.id'
			);
	$this->db->select($select);    
	$this->db->from('plan_detail');
	$this->db->join('plan', 'plan.id = plan_detail.plan_id', 'inner');
	$this->db->group_by('plan_detail.po_id');
	$this->db->where($where);
	return $this->db->get();
}
function get_prepare_plan($tanggal){
	$where=array(
			'plan.tanggal'=>$tanggal
			);
	$select=array(
				'plan.tanggal',
				'plan.customer_id',
				'plan.id'
			);
	$this->db->select($select);    
	$this->db->from('plan');
	$this->db->where($where);
	return $this->db->get();
}
function get_prepare_planblmtutup(){
	$where=array(
			'plan.proses'=>1
			);
	$select=array(
				'plan.tanggal',
				'plan.customer_id',
				'plan.id'
			);
	$this->db->select($select);    
	$this->db->from('plan');
	$this->db->where($where);
	return $this->db->get();
}
function get_prepare_detail($idpo,$idplan){
	$where=array(
			'plan_detail.plan_id'=>$idplan,
			'plan_detail.po_id'=>$idpo
			);
	$select=array(
				'plan_detail.id'
			);
	$this->db->select($select);    
	$this->db->from('plan_detail');
	$this->db->where($where);
	return $this->db->get();
}
function get_by_detail($id){
	$where=array(
			'plan_detail.plan_id'=> $id
			);
	$select=array(
				'plan_detail.id',
				'plan_detail.plan_id',
				'plan_detail.po_id',
				'plan_detail.po',
				'plan_detail.po_detail_id',
				'plan_detail.jenis',
				'plan_detail.gsm',
				'plan_detail.lebar',
				'plan_detail.jumlah',
				'plan_detail.q1',
				'plan_detail.q2',
				'plan_detail.q3',
				'plan_detail.q4',
				'plan_detail.barang'
			);
	$this->db->select($select);    
	$this->db->from('plan_detail');
	$this->db->where($where);
	return $this->db->get();
}
function get_sisa_close($id){
	$where=array(
			'plan.id'=> $id
			);
	$select=array(
				'plan.id',
				'sum(plan_detail.jumlah) as qtyplan',
				'sum(plan_detail.sisa1+plan_detail.sisa2+plan_detail.sisa3+plan_detail.sisa4) as qtykitir',
				'plan.tanggal'
			);
	$this->db->select($select);
	$this->db->from('plan');
	$this->db->join('plan_detail', 'plan.id = plan_detail.plan_id', 'inner');
	$this->db->where($where);
	$this->db->group_by('plan.id');
	return $this->db->get();
}
function get_by_detail_id($id){
	$where=array(
			'plan_detail.id'=> $id
			);
	$select=array(
				'plan_detail.id',
				'plan_detail.plan_id',
				'plan_detail.po_id',
				'plan_detail.po',
				'plan_detail.po_detail_id',
				'plan_detail.jenis',
				'plan_detail.gsm',
				'plan_detail.lebar',
				'plan_detail.jumlah',
				'plan_detail.q1',
				'plan_detail.q2',
				'plan_detail.q3',
				'plan_detail.q4',
				'plan_detail.barang'
			);
	$this->db->select($select);    
	$this->db->from('plan_detail');
	$this->db->where($where);
	return $this->db->get();
}
function save_plan_barang($data) {
	$this->db->insert('plan_barang',$data);
}
function save_plan($data) {
	$this->db->insert($this->table_name,$data);
	return $this->db->insert_id();
}
function save_plan_detail($datas,$id) {
	$data = array();
	foreach($datas as $data2){
		$data[] = $data2 + array('plan_id'=>$id);
	}
	$this->db->insert_batch('plan_detail',$data);
}
function update_plan($id,$data) {
	$this->db->where($this->primary_key,$id);
	$this->db->update($this->table_name,$data);
}
function update_plan_detail($id,$data) {
	$this->db->where('id',$id);
	$this->db->update('plan_detail',$data);
}
function update_plan_barang_kitir($id,$kitir) {
	$this->db->where('plan_barang.id',$id);
	$this->db->update('plan_barang',array('plan_detail'=>$kitir));
	$this->db->select('plan_barang.berat as berat');    
	$this->db->from('plan_barang');
	$this->db->where('plan_barang.id',$id);
	return $this->db->get()->row();
}
function delete($id) {
	$this->db->where('id',$id);
	$this->db->delete('plan');
	$this->db->where('plan_id',$id);
	$this->db->delete('plan_detail');
}
function delete_detail($id) {
	$this->db->where('id',$id);
	$this->db->delete('plan_detail');
}
function update_sisa_plan($id,$mutu,$berat)
{
	if($mutu==1){
		$this->db->set('sisa1', 'sisa1 - ' . (int) $berat, FALSE);
	}
	if($mutu==2){
		$this->db->set('sisa2', 'sisa2 - ' . (int) $berat, FALSE);
	}
	if($mutu==3){
		$this->db->set('sisa3', 'sisa3 - ' . (int) $berat, FALSE);
	}
	if($mutu==4){
		$this->db->set('sisa4', 'sisa4 - ' . (int) $berat, FALSE);
	}
	$this->db->where('id',$id);
	$this->db->update('plan_detail');
}
function get_customer(){
	$servercustomer = json_decode(file_get_contents("http://192.168.1.200/laporan/halaman/produksi.php?aksi=listcustomer",true),true);
	return $servercustomer;	
}
function get_po($id,$pm){
	$pocustomer = json_decode(file_get_contents("http://".server()."/api/order/caripo/".$id."/".$pm,true),true);
	return $pocustomer;	
}
function get_detailpo($id){
	$pocustomer = json_decode(file_get_contents("http://".server()."/api/order/detailpo/".$id,true),true);
	return $pocustomer;	
}

}
