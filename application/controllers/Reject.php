<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reject extends CI_Controller {
	private $limit=10;
	function __construct(){
		parent::__construct();
		
		if($this->session->userdata('status') != "login"){
			redirect(base_url("auth"));
		}
		$this->load->model('reject_model','',TRUE);
		$this->load->helper(array('form'));
	}
 
	function add(){
		$master=json_decode(file_get_contents("http://".server()."/api/master/barang"));
		$data['jenis'] = $master->jenis;
		$data['kepala'] = $master->kepala;
		$data['warna'] = $master->warna;
		$data['masalah'] = $master->masalah;
		$data['reject']=(object)array();
		$this->load->view('reject/add.php',$data);
		
	}
	function kirim(){
		$customer=json_decode(file_get_contents("http://".server()."/api/customer/viewall"));
		$master=json_decode(file_get_contents("http://".server()."/api/master/barang"));
		$data['master'] = $master;
		$data['customer'] = $customer;
		$data['reject']=(object)array();
		$data['roll']=$this->reject_model->get_by_stock()->result();
		$this->load->view('reject/kirim.php',$data);
		
	}
	function lapstock(){
		$from=$this->input->post('tanggal');
		$to=$this->input->post('tanggal2');
		$customer=json_decode(file_get_contents("http://".server()."/api/customer/viewall"));
		$master=json_decode(file_get_contents("http://".server()."/api/master/barang"));
		$data['master'] = $master;
		$data['customer'] = $customer;
		$data['reject']=(object)array(
						'tanggal'=>$from,
						'tanggal2'=>$to
						);
		$data['roll']=$this->reject_model->get_by_stock_tgl($from,$to)->result();
		$this->load->view('reject/stok.php',$data);
		
	}
	function lapkirim(){
		$from=$this->input->post('tanggal');
		$to=$this->input->post('tanggal2');
		$customer=json_decode(file_get_contents("http://".server()."/api/customer/viewall"));
		$master=json_decode(file_get_contents("http://".server()."/api/master/barang"));
		$data['master'] = $master;
		$data['customer'] = $customer;
		$data['reject']=(object)array(
						'tanggal'=>$from,
						'tanggal2'=>$to
						);
		$data['roll']=$this->reject_model->get_by_kirim_tgl($from,$to)->result();
		$this->load->view('reject/viewkirim.php',$data);
		
	}
	function delete() {
		$this->load->library('user_agent');
		$id=$this->uri->segment(3);
		$this->reject_model->delete($id);
		redirect($this->agent->referrer(),'refresh');
	}
	function update(){
		$master=json_decode(file_get_contents("http://".server()."/api/master/barang"));
		$data['jenis'] = $master->jenis;
		$data['kepala'] = $master->kepala;
		$data['warna'] = $master->warna;
		$data['masalah'] = $master->masalah;
		$alls=$this->reject_model->get_by_id($this->uri->segment(3))->result();
		foreach ($alls as $value) {
			$hasil=(object)array(
						"id"=>$value->id,
						"datetime"=>tglsaja($value->datetime),
						"pm"=>$value->pm,
						"roll"=>$value->roll,
						"jenis"=>$value->jenis,
						"gsm"=>$value->gsm,
						"lebar"=>$value->lebar,
						"berat"=>$value->berat,
						"warna"=>$value->warna,
						"keterangan"=>$value->keterangan
						);
		}
		$data['reject']=$hasil;
		$this->load->view('reject/add.php',$data);
		
	}
	function savekirim(){
		if($this->input->post('id')==0){
		$form = array(
					'tanggal'=>date('Y-m-d',strtotime($this->input->post('tanggal'))),
					'datetime'=>now(),
					'customer'=>$this->input->post('customer'),
					'po'=>$this->input->post('po'),
					'kendaraan'=>$this->input->post('kendaraan'),
					'keterangan'=>$this->input->post('keterangan')
					);
		$no_roll = $this->input->post('no_roll');
		$id = $this->reject_model->addkirim($form);
		$this->reject_model->tandaikirim($id,$no_roll);
		$this->reject_model->hapusstock($no_roll);
		$this->reject_model->hapusstock2($no_roll);
		redirect(site_url('reject/cetakdialog/'.$id));
		}else{
		$form = array(
					'tanggal'=>date('Y-m-d',strtotime($this->input->post('tanggal'))),
					'datetime'=>now(),
					'customer'=>$this->input->post('customer'),
					'po'=>$this->input->post('po'),
					'kendaraan'=>$this->input->post('kendaraan'),
					'keterangan'=>$this->input->post('keterangan')
					);
		$no_roll = $this->input->post('no_roll');
		$id = $this->input->post('id');
		$this->reject_model->updatekirim($id,$form);
		$this->reject_model->hapusstock($no_roll);
		$this->reject_model->hapusstock2($no_roll);
		redirect(site_url('reject/cetakdialog/'.$id));
		}
	}
	function cetakdialog(){
		$id = $this->uri->segment(3);
		$data['master']=json_decode(file_get_contents("http://".server()."/api/master/barang"));
		$data['cetak']=$this->reject_model->get_by_kirim($id)->row();
		$data['roll']=$this->reject_model->get_by_kirimdetail($id)->result();
		$this->load->view('reject/cetak.php',$data);
		}
	function last(){
		$alls=$this->reject_model->get_by_last()->result();
		$master=json_decode(file_get_contents("http://".server()."/api/master/barang"));
		//$hasil=array();
		foreach ($alls as $value) {
			$hasil[]=array(
						"id"=>$value->id,
						"datetime"=>tglshort($value->datetime),
						"kode"=>koderoll2($master->tahun,$value->datetime,$value->pm,$value->roll),
						"pm"=>$value->pm,
						"jenis"=>arrtostr(cariarray($master->jenis,$value->jenis)),
						"gsm"=>$value->gsm,
						"lebar"=>$value->lebar,
						"berat"=>number_format($value->berat),
						"warna"=>arrtostr(cariarray($master->warna,$value->warna)),
						"keterangan"=>$value->keterangan
						);
		}
		$this->output->set_content_type('application/json');
		$callback = $this->input->get('callback',TRUE);
		if(empty($callback)){
			$this->output->set_output(json_encode($hasil));
		}else{
			$this->output->set_output($callback."(".json_encode($hasil).")");
		}
		
		
	}
	function index($offset=0,$order_column='id',$order_type='asc'){
		$master=json_decode(file_get_contents("http://".server()."/api/master/barang"));
		$data['jenis'] = $master->jenis;
		$data['kepala'] = $master->kepala;
		$data['warna'] = $master->warna;
		$data['tahun'] = $master->tahun;
		$data['masalah'] = $master->masalah;
		$this->load->library(array('pagination','table'));
		if (empty($offset)) $offset=0;
		if (empty($order_column)) $order_column='id';
		if (empty($order_type)) $order_type='asc';
		//TODO: check for valid column
		$alls=$this->reject_model->get_paged_list($this->limit,
		$offset,$order_column,$order_type)->result();
		$config['base_url']= site_url('reject/index/');
		$config['total_rows']=$this->reject_model->count_all();
		$config['per_page']=$this->limit;
		$config['first_link'] = false; 
    	$config['last_link']  = false;
		$config['full_tag_open'] = '<ul class="pagination pagination-sm no-margin pull-right">';
		$config['full_tag_close'] = '</ul>';
		$config['first_tag_open'] = '<li>';
		$config['first_tag_close'] = '</li>';
		$config['last_tag_open'] = '<li>';
		$config['last_tag_close'] = '</li>';
		$config['prev_tag_open'] = '<li>';
		$config['prev_tag_close'] = '</li>';
		$config['next_tag_open'] = '<li>';
		$config['next_tag_close'] = '</li>';
		$config['cur_tag_open'] = '<li><a href="#"><b>';
		$config['cur_tag_close'] = '</b></a></li>';
		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';
		$config['last_link'] = '<i class="fa fa-angle-double-right"></i>';
		$config['first_link'] = '<i class="fa fa-angle-double-left"></i>';
    	$config ['prev_link'] = '<i class="fa fa-caret-left"></i>';
    	$config ['next_link'] = '<i class="fa fa-caret-right"></i>';
		//$config['uri_segment']=3;
		$this->pagination->initialize($config);
		$data['pagination']=$this->pagination->create_links();
		// generate table data
		
		$this->table->set_empty("&nbsp;");
		$tmpl = array ('table_open'=>'<table id="tabellaporan" class="table table-hover">');
		$this->table->set_template($tmpl); 
		$new_order=($order_type=='asc'?'desc':'asc');
		$this->table->set_heading(
		anchor('reject/index/'.$offset.'/tanggal/'.$new_order,'Tanggal'),
		'Kode',
		anchor('reject/index/'.$offset.'/pm/'.$new_order,'PM'),
		'Jenis',
		anchor('reject/index/'.$offset.'/gsm/'.$new_order,'GSM'),
		anchor('reject/index/'.$offset.'/lebar/'.$new_order,'Lebar'),
		'Berat',
        'Warna',
        'Keterangan',
		'&nbsp;',
		'&nbsp;'
	);
	$i=0+$offset;
	foreach ($alls as $all){
		$this->table->add_row(
			date('d-M-y',strtotime($all->datetime)),
			koderoll2($master->tahun,$all->datetime,$all->pm,$all->roll),
			$all->pm,
            arrtostr(cariarray($master->jenis,$all->jenis)),
			$all->gsm,
			$all->lebar,
			number_format($all->berat),
			arrtostr(cariarray($master->warna,$all->warna)),
			$all->keterangan,
			anchor('reject/update/'.$all->id,'&nbsp;',array('class'=>'fa fa-pencil')),
			anchor('reject/delete/'.$all->id,'&nbsp;',array('class'=>'fa fa-trash','onclick'=>"return confirm('Apakah Anda yakin ingin menghapus roll ini?')"))
		);
	}
	$data['table']=$this->table->generate();
	
		$this->load->view('reject/view.php',$data);
		
	}
	function save(){
		if($this->input->post('id')==0){
			$roll = array(
					'datetime'=>date('Y-m-d',strtotime($this->input->post('datetime'))),
					'datetime2'=>now(),
					'pm'=>(int)$this->input->post('pm'),
					'jenis'=>(int) $this->input->post('jenis'),
					'gsm'=>(int) $this->input->post('gsm'),
					'lebar'=>(int) $this->input->post('lebar'),
					'warna'=>(int) $this->input->post('warna'),
					'roll'=>(int) $this->input->post('roll'),
					'berat'=>$this->input->post('berat'),
					'keterangan'=>$this->input->post('keterangan'),
					'stock'=>1,
					'stock2'=>1
					);
			$id = $this->reject_model->add($roll);		
		} else {
			$roll = array(
					'datetime'=>date('Y-m-d',strtotime($this->input->post('datetime'))),
					'pm'=>(int)$this->input->post('pm'),
					'jenis'=>(int) $this->input->post('jenis'),
					'gsm'=>(int) $this->input->post('gsm'),
					'lebar'=>(int) $this->input->post('lebar'),
					'warna'=>(int) $this->input->post('warna'),
					'roll'=>(int) $this->input->post('roll'),
					'berat'=>$this->input->post('berat'),
					'keterangan'=>$this->input->post('keterangan')
					);
			$this->reject_model->update($this->input->post('id'),$roll);		
		}
		

	}
}
