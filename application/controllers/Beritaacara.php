<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Beritaacara extends CI_Controller {
	private $limit=20;
	function __construct(){
		parent::__construct();
		
		if($this->session->userdata('status') != "login"){
			redirect(base_url("auth"));
		}
		$this->load->model('beritaacara_model','',TRUE);
		$this->load->library('user_agent');
		$this->load->helper(array('form'));
	}
 
	function add(){
		$master=json_decode(file_get_contents("http://".server()."/api/master/barang"));
		$data['jenis'] = $master->jenis;
		$data['kepala'] = $master->kepala;
		$data['warna'] = $master->warna;
		$data['masalah'] = $master->masalah;
		$data['beritaacara']=(object)array();
		$this->load->view('beritaacara/add.php',$data);
		
	}
	
	function update(){
		$master=json_decode(file_get_contents("http://".server()."/api/master/barang"));
		$data['jenis'] = $master->jenis;
		$data['kepala'] = $master->kepala;
		$data['warna'] = $master->warna;
		$data['masalah'] = $master->masalah;
		$alls=$this->beritaacara_model->get_by_id($this->uri->segment(3))->result();
		$masalah = $this->beritaacara_model->get_by_masalah($this->uri->segment(3));
		foreach ($alls as $value) {
			$hasil=(object)array(
						"id"=>$value->id,
						"pm"=>$value->pm,
						"datetime"=>tglsaja($value->datetime),
						"shift"=>$value->shift,
						"kepala"=>$value->kepala,
						"no_roll"=>$value->no_roll,
            			"jenis"=>$value->jenis,
						"no_jumbo"=>$value->no_jumbo,
						"no_roll"=>$value->no_roll,
						"lebar"=>$value->lebar,
						"lebar_2"=>$value->lebar_2,
						"berat"=>$value->berat,
						"mutu"=>$value->mutu,
						"diameter"=>$value->diameter,
						"gsm"=>$value->gsm,
						"gsm_2"=>$value->gsm_2,
						"rct"=>$value->rct,
						"bst"=>$value->bst,
						"cobb"=>$value->cobb,
						"smooth"=>$value->smooth,
						"putus"=>$value->putus,
						"src"=>$value->src,
						"export"=>$value->export,
						"warna"=>$value->warna,
						"keterangan"=>$value->keterangan,
						"masalah"=>$masalah
						);
		}
		$data['beritaacara']=$hasil;
		$this->load->view('beritaacara/add.php',$data);
		
	}
	function last(){
		$alls=$this->beritaacara_model->get_by_last()->result();
		
		$this->output->set_content_type('application/json');
		$callback = $this->input->get('callback',TRUE);
		if(empty($callback)){
			$this->output->set_output(json_encode($alls));
		}else{
			$this->output->set_output($callback."(".json_encode($alls).")");
		}
	}
	function belumcetak(){
		if($this->uri->segment(3)!=null){
			$pm=$this->uri->segment(3);
		}else{
			$pm=0;
		}
		$alls=$this->beritaacara_model->get_by_blmcetak($pm)->result();
		$data['roll']=$alls;
		$data['master']=json_decode(file_get_contents("http://".server()."/api/master/barang"));
		$this->load->view('beritaacara/listRoll.php',$data);
	}
	function belumupload(){
		
	}
	function cetak(){
		$master=json_decode(file_get_contents("http://".server()."/api/master/barang"));
		$data['master'] = $master;
		$data['beritaacara']=(object)array();
		$data['refer']=$this->agent->referrer();
		$this->load->view('beritaacara/print.php',$data);
	}
	function cetaklabel(){
		$id = $this->uri->segment(3);
		$master=json_decode(file_get_contents("http://".server()."/api/master/barang"));
		$data['master'] = $master;
		$data['roll']=$this->beritaacara_model->get_by_id($id)->row();
		$data['refer']=$this->agent->referrer();
		$data['masalah'] = $this->beritaacara_model->get_by_masalah($id);
		$this->load->view('beritaacara/barang_label.php',$data);
	}
	function cetakupdate(){
		$master=json_decode(file_get_contents("http://".server()."/api/master/barang"));
		$data['master'] = $master;
		$data['beritaacara']=(object)array();
		$data['refer']=$this->agent->referrer();
		$data['beritaacara']=$this->beritaacara_model->get_by_print($this->uri->segment(3))->row($this->uri->segment(3));
		$this->load->view('beritaacara/print2.php',$data);
	}
	function viewall(){
		$master=json_decode(file_get_contents("http://".server()."/api/master/barang"));
		$data['jenis'] = $master->jenis;
		$data['kepala'] = $master->kepala;
		$data['warna'] = $master->warna;
		$data['masalah'] = $master->masalah;
		$this->load->library(array('table'));
		$alls=$this->beritaacara_model->get_by_all_noprint_noupload()->result();
		$this->table->set_empty("&nbsp;");
		$tmpl = array ('table_open'=>'<table id="tabellaporan" class="table table-hover"  width="200%">');
		$this->table->set_template($tmpl); 
		$this->table->set_heading(
		'&nbsp;',
		'&nbsp;',
		'&nbsp;',
		'PM',
		'Tanggal',
		'KodeRoll',
		'Jenis',
		'Jumbo',
		'No<br />Roll',
		'Lebar',
		'Berat',
		'Mutu',
		'GSM',
		'RCT',
		'BST',
		'Cobb',
		'Smooth',
		'Putus',
		'SRC',
        'Export',
        'Warna',
        'Masalah',
        'Keterangan'
	);
	foreach ($alls as $all){
		$daftarmasalah = $this->beritaacara_model->get_by_masalah($all->id);
		$this->table->add_row(
			anchor('beritaacara/cetaklabel/'.$all->id,'&nbsp;',array('target' => '_blank','class'=>'fa fa-print')),
			anchor('beritaacara/update/'.$all->id,'&nbsp;',array('class'=>'fa fa-pencil')),
			anchor('beritaacara/delete/'.$all->id,'&nbsp;',array('class'=>'fa fa-trash','onclick'=>"return confirm('Apakah Anda yakin ingin menghapus roll ini?')")),
			$all->pm,
			date('d-M-y',strtotime($all->datetime)),
			koderoll($master->tahun,$all->datetime,$all->pm,$all->no_roll),
            arrtostr(cariarray($data['jenis'],$all->jenis)),
			$all->no_jumbo,
			$all->no_roll,
			$all->lebar_2,
			number_format($all->berat),
			$all->mutu,
			$all->gsm,
			$all->rct,
			$all->bst,
			$all->cobb,
			$all->smooth,
			$all->putus,
			$all->src,
			$all->export,
			arrtostr(cariarray($data['warna'],$all->warna)),
			gabungnama($daftarmasalah,$data['masalah']),
			$all->keterangan
		);
	}
	$data['table']=$this->table->generate();
		$this->load->view('beritaacara/viewall.php',$data);
	}
	
	function index($offset=0,$order_column='id',$order_type='asc'){
		$master=json_decode(file_get_contents("http://".server()."/api/master/barang"));
		$data['jenis'] = $master->jenis;
		$data['kepala'] = $master->kepala;
		$data['warna'] = $master->warna;
		$data['masalah'] = $master->masalah;
		$this->load->library(array('pagination','table'));
		if (empty($offset)) $offset=0;
		if (empty($order_column)) $order_column='id';
		if (empty($order_type)) $order_type='desc';
		//TODO: check for valid column
		$alls=$this->beritaacara_model->get_paged_list($this->limit,
		$offset,$order_column,$order_type)->result();
		$config['base_url']= site_url('beritaacara/index/');
		$config['total_rows']=$this->beritaacara_model->count_all();
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
		anchor('beritaacara/index/'.$offset.'/pm/'.$new_order,'PM'),
		anchor('beritaacara/index/'.$offset.'/datetime/'.$new_order,'Tgl'),
		'KodeRoll',
		anchor('beritaacara/index/'.$offset.'/jenis/'.$new_order,'Jenis'),
		anchor('beritaacara/index/'.$offset.'/no_jumbo/'.$new_order,'Jmb'),
		anchor('beritaacara/index/'.$offset.'/no_roll/'.$new_order,'No<br />Roll'),
		anchor('beritaacara/index/'.$offset.'/lebar_2/'.$new_order,'Lebar'),
		'Dia<br>meter',
		'Berat',
		'Mutu',
		'GSM',
		'RCT',
		'BST',
		'Cobb',
		'Putus',
		'SRC',
        'Export',
        'Warna',
        'Masalah',
        'Keterangan',
		'&nbsp;',
		'&nbsp;'
	);
	$i=0+$offset;
	foreach ($alls as $all){
		$daftarmasalah = $this->beritaacara_model->get_by_masalah($all->id);
		$this->table->add_row(
			$all->pm,
			date('d-M-y',strtotime($all->datetime)),
			koderoll($master->tahun,$all->datetime,$all->pm,$all->no_roll),
            arrtostr(cariarray($data['jenis'],$all->jenis))." ".$all->gsm,
			$all->no_jumbo,
			$all->no_roll,
			$all->lebar_2,
			$all->diameter,
			number_format($all->berat),
			'Q'.$all->mutu,
			$all->gsm_2,
			$all->rct,
			$all->bst,
			$all->cobb,
			$all->putus,
			$all->src,
			$all->export,
			arrtostr(cariarray($data['warna'],$all->warna)),
			gabungnama($daftarmasalah,$data['masalah']),
			$all->keterangan,
			anchor('beritaacara/update/'.$all->id,'&nbsp;',array('class'=>'fa fa-pencil')),
			anchor('beritaacara/delete/'.$all->id,'&nbsp;',array('class'=>'fa fa-trash','onclick'=>"return confirm('Apakah Anda yakin ingin menghapus roll ini?')"))
		);
	}
	$data['table']=$this->table->generate();
	
		$this->load->view('beritaacara/view.php',$data);
		
	}
	function viewcetak($offset=0,$order_column='id',$order_type='asc'){
		$master=json_decode(file_get_contents("http://".server()."/api/master/barang"));
		$data['jenis'] = $master->jenis;
		$data['kepala'] = $master->kepala;
		$data['warna'] = $master->warna;
		$data['masalah'] = $master->masalah;
		$this->load->library(array('pagination','table'));
		if (empty($offset)) $offset=0;
		if (empty($order_column)) $order_column='id';
		if (empty($order_type)) $order_type='asc';
		//TODO: check for valid column
		$alls=$this->beritaacara_model->get_cetak_paged_list($this->limit,
		$offset,$order_column,$order_type)->result();
		$config['base_url']= site_url('beritaacara/viewcetak/');
		$config['total_rows']=$this->beritaacara_model->count_all_viewcetak();
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
		anchor('beritaacara/viewcetak/'.$offset.'/pm/'.$new_order,'PM'),
		anchor('beritaacara/viewcetak/'.$offset.'/tanggal/'.$new_order,'Tanggal'),
        'Masalah',
        'Alasan',
		'&nbsp;',
		'&nbsp;'
		,'&nbsp;'
	);
	$i=0+$offset;
	foreach ($alls as $all){
		$this->table->add_row(
			$all->pm,
			date('d-M-y',strtotime($all->tanggal)),
			$all->masalah,
			$all->alasan,
			anchor('beritaacara/cetakupdate/'.$all->id,'&nbsp;',array('class'=>'fa fa-pencil')),
			anchor('beritaacara/cetakdialog/'.$all->id,'&nbsp;',array('class'=>'fa fa-print','target' => '_blank'))
			,anchor('beritaacara/deletecetak/'.$all->id,'&nbsp;',array('class'=>'fa fa-trash','onclick'=>"return confirm('Apakah Anda yakin ingin menghapus roll ini?')"))
		);
	}
	$data['table']=$this->table->generate();
	
		$this->load->view('beritaacara/viewCetak.php',$data);
		
	}
	function saveprint(){
		if($this->input->post('id')==0){
		$form = array(
					'tanggal'=>date('Y-m-d',strtotime($this->input->post('tanggal'))),
					'tanggal_input'=>now(),
					'pm'=>(int) $this->input->post('pm'),
					'masalah'=>$this->input->post('masalah'),
					'alasan'=>$this->input->post('alasan')
					);
		$no_roll = $this->input->post('no_roll');
		$id = $this->beritaacara_model->addprint($form);
		$this->beritaacara_model->tandaiprint($id,$no_roll);
		redirect(site_url('beritaacara/cetakdialog/'.$id));
		}else{
		$form = array(
					'tanggal'=>date('Y-m-d',strtotime($this->input->post('tanggal'))),
					'tanggal_input'=>now(),
					'pm'=>(int) $this->input->post('pm'),
					'masalah'=>$this->input->post('masalah'),
					'alasan'=>$this->input->post('alasan')
					);
		$id = $this->input->post('id');
		$this->beritaacara_model->updateprint($id,$form);
		redirect(site_url('beritaacara/cetakdialog/'.$id));
		}
		
	}
	function cetakdialog(){
		
		$id = $this->uri->segment(3);
		$data['master']=json_decode(file_get_contents("http://".server()."/api/master/barang"));
		$data['cetak']=$this->beritaacara_model->get_by_print($id)->row();
		$data['roll']=$this->beritaacara_model->get_by_print_detail($id)->result();
		$this->load->view('beritaacara/cetak.php',$data);
		}
	function deletecetak(){
		$id = $this->uri->segment(3);
		$this->beritaacara_model->deletecetak($id);
		redirect($this->agent->referrer());
		}
	function delete(){
		$id = $this->uri->segment(3);
		$this->beritaacara_model->delete($id);
		redirect($this->agent->referrer());
		}
	function save(){
		if($this->input->post('id')==0){
		$roll = array(
					'datetime'=>date('Y-m-d',strtotime($this->input->post('datetime'))),
					'datetime2'=>now(),
					'pm'=>(int) $this->input->post('pm'),
					'jenis'=>(int) $this->input->post('jenis'),
					'gsm'=>(int) $this->input->post('gsm'),
					'lebar'=>$this->input->post('lebar'),
					'shift'=>(int) $this->input->post('shift'),
					'kepala'=>(int) $this->input->post('kepala'),
					'no_jumbo'=>(int) $this->input->post('no_jumbo'),
					'no_roll'=>(int) $this->input->post('no_roll'),
					'lebar_2'=>$this->input->post('lebar_2'),
					'diameter'=>$this->input->post('diameter'),
					'berat'=>$this->input->post('berat'),
					'mutu'=>$this->input->post('mutu'),
					'gsm_2'=>$this->input->post('gsm_2'),
					'rct'=>$this->input->post('rct'),
					'bst'=>$this->input->post('bst'),
					'cobb'=>$this->input->post('cobb'),
					'smooth'=>$this->input->post('smooth'),
					'pm'=>$this->input->post('pm'),
					'putus'=>$this->input->post('putus'),
					'warna'=>$this->input->post('warna'),
					'keterangan'=>$this->input->post('keterangan'),
					'src'=>(int) $this->input->post('src'),
					'export'=>(int) $this->input->post('export'),
					'upload'=>0
					);
		$masalah = $this->input->post('masalah');
		$id = $this->beritaacara_model->add($roll);
		if(isset($masalah)){
			
	    	$this->beritaacara_model->add_masalah($masalah,$id);
			}
		echo $id;
		}else{
			$roll = array(
					'datetime'=>date('Y-m-d',strtotime($this->input->post('datetime'))),
					'pm'=>(int) $this->input->post('pm'),
					'jenis'=>(int) $this->input->post('jenis'),
					'gsm'=>(int) $this->input->post('gsm'),
					'lebar'=>$this->input->post('lebar'),
					'shift'=>(int) $this->input->post('shift'),
					'kepala'=>(int) $this->input->post('kepala'),
					'no_jumbo'=>(int) $this->input->post('no_jumbo'),
					'no_roll'=>(int) $this->input->post('no_roll'),
					'lebar_2'=>$this->input->post('lebar_2'),
					'diameter'=>$this->input->post('diameter'),
					'berat'=>$this->input->post('berat'),
					'mutu'=>$this->input->post('mutu'),
					'gsm_2'=>$this->input->post('gsm_2'),
					'rct'=>$this->input->post('rct'),
					'bst'=>$this->input->post('bst'),
					'cobb'=>$this->input->post('cobb'),
					'smooth'=>$this->input->post('smooth'),
					'pm'=>$this->input->post('pm'),
					'putus'=>$this->input->post('putus'),
					'warna'=>$this->input->post('warna'),
					'keterangan'=>$this->input->post('keterangan'),
					'src'=>(int) $this->input->post('src'),
					'export'=>(int) $this->input->post('export')
					);
			$this->beritaacara_model->update($this->input->post('id'),$roll);
			$masalah = $this->input->post('masalah');
			$this->beritaacara_model->delete_masalah_by_telat($this->input->post('id'));
			if(isset($masalah)){
			
			$this->beritaacara_model->add_masalah($masalah,$this->input->post('id'));
			}
			echo $this->input->post('id');
		}

	}
}
