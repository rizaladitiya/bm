<?php
defined('BASEPATH') OR exit('No direct script access allowed');


if(!function_exists('baca_konfig'))
{
	function baca_konfig($nama)
	{
		$CI=& get_instance();
		$CI->load->library('m_db');
		$item=$CI->m_db->get_row('config',array(),$nama);
		return $item;
	}
}
if(!function_exists('referrer'))
{
	function referrer()
	{
		$CI=& get_instance();
		$CI->load->library('user_agent');
		if ($CI->agent->is_referral())
		{
    		return $CI->agent->referrer();
		}
	}
}
if(!function_exists('ada'))
{
	function ada($tutup) {
		if($tutup==1){
			$hasil="*";
		}else{
			$hasil="&nbsp;";
		}
		return $hasil;
	}
}
if(!function_exists('gantikosongan'))
{
	function gantikosongan($tutup) {
		
		return str_replace('_', '', $tutup);
	}
}
if(!function_exists('splitslash'))
{
	function splitslash($text)
	{
		if(strpos($text,"/")==true){
			$hasil=explode("/",$text);
		}
		return $hasil;
	}
}
if(!function_exists('tambahnol1'))
{
	function tambahnol1($text)
	{
		$text = ltrim($text, '0');
	   $hasil=($text>9)?$text:'0'.$text;
	   return $hasil;
	}
}
if(!function_exists('tambahnol3'))
{
	function tambahnol3($text)
	{
		$text = ltrim($text, '0');
	   $hasil=($text>9)?($text>99)?($text>999)?$text:'0'.$text:'00'.$text:'000'.$text;
	   return $hasil;
	}
}
if(!function_exists('removeslash'))
{
	function removeslash($text)
	{
		if(strpos($text,"/")==true){
			$hasil=str_replace("/","",$text);
		}
		return $hasil;
	}
}
if(!function_exists('gabungslash1'))
{
	function gabungslash1($string)
	{
		
		$step1 = gantikosongan($string);
		$step2 = splitslash($step1);
		$step2[0] = tambahnol1($step2[0]);
		$step2[1] = tambahnol1($step2[1]);
		$step3 = implode("",$step2);
		return $step3;
	}
}
if(!function_exists('gabungslash3'))
{
	function gabungslash3($string)
	{
		$step1 = gantikosongan($string);
		$step2 = splitslash($step1);
		$step2[0] = tambahnol3($step2[0]);
		$step2[1] = tambahnol3($step2[1]);
		$step3 = implode("",$step2);
		return $step3;
	}
}
if(!function_exists('kontroler'))
{
	function kontroler($nama)
	{
		$CI=& get_instance();
		$item = $CI->uri->segment(1);
		if (strtolower($item)==strtolower($nama)){
				return " active";
			}
	}
	
}
if(!function_exists('server'))
{
	function server()
	{
		return "192.168.1.200";
	}
}
if(!function_exists('cekserver'))
{
	function cekserver()
	{
		
		if(server()!="192.168.1.200"){return " server uji coba";}else{return "";}
	}
}
if(!function_exists('sekarang'))
{
	function sekarang()
	{
		return date('Y-m-d');
	}
}
if(!function_exists('now'))
{
	function now()
	{
		return date("Y-m-d H:i:s");
	}
}
if(!function_exists('tglshort'))
{
	function tglshort($tgl)
	{
		return date('d-M-y',strtotime($tgl));
	}
}
if(!function_exists('showmenu'))
{
	function showmenu($kelompok,$array)
	{
		if (in_array($kelompok, $array)) {
    		return "''";
		}else {
			return "style='display:none'";
			}
	}
}
if(!function_exists('tglsaja'))
{
	function tglsaja($tgl)
	{
		return date('Y-m-d',strtotime($tgl));
	}
}
if(!function_exists('kertas'))
{
	function kertas($jenis='',$gsm='',$lebar='')
	{
		
		$hasil = $jenis;
		if (!empty($gsm)){
			$hasil = $hasil." ".$gsm." GSM";
		}
		if (!empty($lebar)){
			$hasil = $hasil." ".$lebar." CM";
		}
		return $hasil;
	}
}
if(!function_exists('httpPost'))
{
	function httpPost($url, $data)
	{
    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_POST, true);
    curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($data));
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($curl);
    curl_close($curl);
    return $response;
	}
}
if(!function_exists('pm'))
{
	function pm($no)
	{
		if($no==0){
			$hasil="1 & 2";	
		}else{
			$hasil=$no;	
		}
		return $hasil;
	}
}
if(!function_exists('koderoll2'))
{
	function koderoll2($mastertahun,$tgl,$pm,$roll)
	{
		$hasil="";
		if($pm==1){
			$hasil="";	
		}else{
			$hasil=$pm;	
		}
		$thn = date('Y',strtotime($tgl));
		$tahun=arrtostr(cariarray($mastertahun,$thn));
		$bln = date('m',strtotime($tgl));
		$string = $tahun.$hasil." ".tambahnol($bln)." ".$roll;
		return $string;
	}
}
if(!function_exists('koderoll'))
{
	function koderoll($mastertahun,$tgl,$pm,$roll)
	{
		$hasil="";
		if($pm==1){
			$hasil="";	
		}else{
			$hasil=$pm;	
		}
		$thn = date('Y',strtotime($tgl));
		$tahun=arrtostr(cariarray($mastertahun,$thn));
		$bln = date('m',strtotime($tgl));
		$tgl = date('d',strtotime($tgl));
		$string = $tahun.$hasil." ".tambahnol($bln)." ".tambahnol($tgl)." ".$roll;
		return $string;
	}
}
if(!function_exists('tambahnol'))
{
	function tambahnol($tambah)
	{
	$digit = strlen($tambah);
	if($digit<=1){
	$hasil = "0".$tambah;
	}else {
	$hasil = $tambah;
	}
	return $hasil;
	}
}
if(!function_exists('tutup'))
{
	function tutup($tutup) {
		if($tutup==1){
			$hasil="*";
		}else{
			$hasil="&nbsp;";
		}
		return $hasil;
	}
}
if(!function_exists('redplus'))
{
	function redplus($text) {
		if($text>0){
			$hasil="<font color='red'>".$text."</font>";
		}else{
			$hasil=$text;
		}
		return $hasil;
	}
}
if(!function_exists('warnatabel'))
{
	function warnatabel($text) {
		if($text%2 == 1){
			$hasil="#FFF5EE";
		}else{
			$hasil="#E0FFFF";
		}
		return $hasil;
	}
}
if(!function_exists('balik'))
{
	function balik($int) {
		if($int==1){
			$hasil=0;
		}
		if($int==0){
			$hasil=1;
		}
		return $hasil;
	}
}
if(!function_exists('gabungnama'))
{
	function gabungnama($data,$array)
	{
		//$newdata=explode(",",$data);
		$find=array();
		$hasil=array();
		foreach($data as $k){
			$find=cariarray($array,$k);
				foreach($find as $fin){
					array_push($hasil,$fin);
				}
		}
		$string = arrtostr($hasil);
		return $string;
	}
}
if(!function_exists('arrtostr'))
{
	function arrtostr($array)
	{
		$string = implode(",",$array);
		return $string;
	}
}
if(!function_exists('cariarray'))
{
	function cariarray($data,$findme)
	{
		$newdata=array();
		foreach ($data as $k=>$v){
			if($v->id==$findme){
					//$newdata=$newdata+array('id'=>$v->id,'nama'=>$v->nama);
					array_push($newdata,$v->nama);
 			}
 		}
		return $newdata;
	}
}
if(!function_exists('gabungarray'))
{
	function gabungarray($a,$field)
	{
		$newdata=array();
    	foreach($a as $array){
			foreach($array as $key=>$item) {
				if($key==$field){
        			array_push($newdata,$item);
					//echo $item;
				}
    		}
		}
		echo implode(',',$newdata);
	}
}
if(!function_exists('balok'))
{
	function hitungrumus($cm,$sg,$kemasan)
	{	
		$CI=& get_instance();
		$CI->load->model('rumus_model');
		$hasil=0;
		
		$idbentuk=$CI->rumus_model->get_kemasan($kemasan)->row()->id_rumus;
		$bentuk=$CI->rumus_model->get_rumus($idbentuk)->row()->nama;
		if(!empty($idbentuk)){
			$nilai=array();
			$hitung=$CI->rumus_model->get_kemasan($kemasan)->result();
			if($bentuk=='Balok'){
				foreach($hitung as $value){
					$nilai[] = $value->value;
				}
				$hasil = ($cm/$nilai[2])*($nilai[0]*$nilai[1]*$nilai[2])*$sg/1000;
			}
			if($bentuk=='Tabung'){
				foreach($hitung as $value){
					$nilai[] = $value->value;
				}
				$hasil = ($cm/$nilai[1])*(3.14*pow($nilai[0],2)*$nilai[1])*$sg/1000;
			}
		}
		return $hasil;
	}
}
if(!function_exists('fieldhidden'))
{
		function fieldhidden($field){
		return array('style' => 'display:none');
		}
}

