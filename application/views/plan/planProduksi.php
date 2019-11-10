<?php

?>
<h1>Laporan  Plan Produksi PPIC<br /><small><?=tglshort($awal)." s/d ".tglshort($akhir);?></small></h1>
<h2>PM 1</h2>
<table width="80%" border="1" cellpadding="0" cellspacing="0">
	<thead>
	<tr align="center">
		<td>Tanggal</td>
		<td>Customer</td>
		<td>PO</td>
		<td>PO PM</td>
		<td>Kirim dari PM</td>
		<td>Jenis</td>
		<td>GSM</td>
		<td>Lebar</td>
		<td>Berat</td>
	  <td>Hasil<br>Produksi
      </tr>
	</thead>
	<tbody>
	<?php
  	$total=0;
  	$total2=0;
	
	
  	foreach($pm1 as $value){
  	?>
	<tr>
		<td><?=$value->tanggal;?></td>
		<td><?=$value->customer_nama;?></td>
		<td align="center"><?=$value->po;?></td>
		<td align="center"><?=$value->pm;?></td>
		<td align="center"><?=$value->pm_hasil;?></td>
		<td align="center"><?=arrtostr(cariarray($masterjenis,$value->jenis));?></td>
		<td align="center"><?=$value->gsm;?></td>
		<td align="center"><?=$value->lebar;?></td>
		<td align="right"><?=number_format($value->jumlah);?></td>
		<td align="center"><?php
			$result = $this->tmpgrupbarang_model->get_by_estimasi($value->pm,$value->jenis,$value->gsm,$value->lebar,$value->warna)->row();
			
			//echo (isset($result->jumlah))?number_format($result->jumlah):0;
			if(isset($result->jumlah)){
				 if($result->ambil==0){
					 
				 $hasil = (int) $result->jumlah-$value->jumlah;
				 $this->tmpgrupbarang_model->updatetmpgrupbarangberat($result->id,($result->jumlah-$value->jumlah));
					 }else{
						 
				 $hasil = (int) $result->ambil-$value->jumlah;
				 $this->tmpgrupbarang_model->updatetmpgrupbarangberat($result->id,($result->ambil-$value->jumlah));
					 }
					if($hasil<0){
					 	//echo number_format($hasil);
						echo "<font color='orange'>Belum Terpenuhi ".number_format($hasil)."Kg</font>";
					} else {
						echo "<font color='darkgreen'>Terpenuhi</font>";
					}
			}else{
				echo "<font color='red'>Belum di produksi</font>";	
			}
		?></td>
	</tr>
	<?php
	$total +=$value->jumlah;
		}
	?>
    <tr align="center">
		<td colspan="8">Total</td>
		<td align="right"><?=number_format($total);?></td>
	    <td></tr>
	</tbody>
</table>
<h3>Hasil Produksi PM 1 <small><?=tglshort($awal)." s/d ".tglshort($akhir);?></small></h3>
<table width="25%" border="1" cellspacing="0" cellpadding="0">
  <tr align="center">
    <td>Jenis</td>
    <td>Jumlah (Kg)</td>
  </tr>
  <?php 
  $total=0;
  foreach($this->tmpgrupbarang_model->get_by_pm(1)->result() as $value){
  ?>
  <tr>
    <td align="center"><?=arrtostr(cariarray($masterjenis,$value->jenis))." ".$value->gsm." GSM ".$value->lebar." CM ".arrtostr(cariarray($masterwarna,$value->warna));?></td>
    <td align="right"><?=number_format($value->jumlah);?></td>
  </tr>
  <?php 
  $total+=$value->jumlah;
  } ?>
  <tr align="center">
    <td>Total</td>
    <td align="right"><?=number_format($total);?></td>
  </tr>
</table>
<hr />
<h2>PM 2</h2>
<table width="80%" border="1" cellpadding="0" cellspacing="0">
  <thead>
    <tr align="center">
      <td>Tanggal</td>
      <td>Customer</td>
      <td>PO</td>
      <td>PO PM</td>
      <td>Kirim dari PM</td>
      <td>Jenis</td>
      <td>GSM</td>
      <td>Lebar</td>
      <td>Berat</td>
      <td>Hasil<br />
        Produksi</td>
    </tr>
  </thead>
  <tbody>
    <?php
  	foreach($pm2 as $value){
  	?>
    <tr>
      <td><?=$value->tanggal;?></td>
      <td><?=$value->customer_nama;?></td>
      <td align="center"><?=$value->po;?></td>
      <td align="center"><?=$value->pm;?></td>
      <td align="center"><?=$value->pm_hasil;?></td>
      <td align="center"><?=arrtostr(cariarray($masterjenis,$value->jenis));?></td>
      <td align="center"><?=$value->gsm;?></td>
      <td align="center"><?=$value->lebar;?></td>
      <td align="right"><?=number_format($value->jumlah);?></td>
      <td align="center"><?php
			$result = $this->tmpgrupbarang_model->get_by_estimasi($value->pm,$value->jenis,$value->gsm,$value->lebar,$value->warna)->row();
			
			//echo (isset($result->jumlah))?number_format($result->jumlah):0;
			if(isset($result->jumlah)){
				 if($result->ambil==0){
					 
				 $hasil = (int) $result->jumlah-$value->jumlah;
				 $this->tmpgrupbarang_model->updatetmpgrupbarangberat($result->id,($result->jumlah-$value->jumlah));
					 }else{
						 
				 $hasil = (int) $result->ambil-$value->jumlah;
				 $this->tmpgrupbarang_model->updatetmpgrupbarangberat($result->id,($result->ambil-$value->jumlah));
					 }
					if($hasil<0){
					 	//echo number_format($hasil);
						echo "<font color='orange'>Belum Terpenuhi ".number_format($hasil)."Kg</font>";
					} else {
						echo "<font color='darkgreen'>Terpenuhi</font>";
					}
			}else{
				echo "<font color='red'>Belum di produksi</font>";	
			}
		?></td>
    </tr>
    <?php
	$total2 +=$value->jumlah;
		}
	?>
     <tr align="center">
      <td colspan="8">Total</td>
      <td align="right"><?=number_format($total2);?></td>
      <td>&nbsp;</td>
    </tr>
  </tbody>
</table>
<h3>Hasil Produksi PM 2 <small><?=tglshort($awal)." s/d ".tglshort($akhir);?></small></h3>
<table width="25%" border="1" cellspacing="0" cellpadding="0">
  <tr align="center">
    <td>Jenis</td>
    <td>Jumlah (Kg)</td>
  </tr>
  <?php 
  $total2=0;
  foreach($this->tmpgrupbarang_model->get_by_pm(2)->result() as $value){
  ?>
  <tr>
    <td align="center"><?=arrtostr(cariarray($masterjenis,$value->jenis))." ".$value->gsm." GSM ".$value->lebar." CM ".arrtostr(cariarray($masterwarna,$value->warna));?></td>
    <td align="right"><?=number_format($value->jumlah);?></td>
  </tr>
  <?php 
  $total2+=$value->jumlah;
  } ?>
  <tr align="center">
    <td>Total</td>
    <td align="right"><?=number_format($total2);?></td>
  </tr>
</table>
