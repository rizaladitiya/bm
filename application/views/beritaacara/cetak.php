<body onload='window.print();window.close();'>
<p><strong><img src="<?=base_url('assets');?>/cetak_clip_image002.jpg" alt="image001" width="301" height="48">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </strong></p>
<small><p><strong>OFFICE</strong><strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </strong><strong>:</strong>&nbsp;&nbsp;&nbsp;&nbsp; Jl. Argopuro 42, Surabaya / Telp. 031-5313920,  5341380 /  Fax. 031-5480681<br>
  <strong>FACTORY</strong><strong>&nbsp; </strong><strong>:</strong>&nbsp;&nbsp;&nbsp;&nbsp; Jl. Raya Cangkringmalang Km. 40, Beji, Pasuruan / Telp. 0343-656288, 656289 / Fax. 0343-655054<br>
  <img src="<?=base_url('assets');?>/cetak_clip_image003.gif" alt="image002" width="609" height="4"></p></small>
<p align="left"><strong>&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; BERITA ACARA</strong></p>
<p><strong>Tanggal&nbsp;&nbsp; :</strong>&nbsp;&nbsp;&nbsp; <?=tglshort($cetak->tanggal);?><br>
  <strong>PM&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; :</strong>&nbsp;&nbsp;&nbsp; <?=$cetak->pm;?><br>
  <strong>Masalah&nbsp; :</strong>&nbsp;&nbsp;&nbsp; <?=$cetak->masalah;?><br>
  <strong>Alasan&nbsp;&nbsp;&nbsp;&nbsp; :&nbsp;&nbsp;&nbsp; <?=$cetak->alasan;?></strong></p>
  <br>
<table border="1" cellspacing="0" cellpadding="0">
  <tr>
    <td width="154" valign="top">
      <p align="center"><strong>Tgl Produksi</strong></p></td>
    <td width="177" valign="top"><p align="center"><strong>Kode</strong></p></td>
    <td width="174" valign="top"><p align="center"><strong>Jenis</strong></p></td>
    <td width="96" valign="top"><p align="center"><strong>Berat</strong></p></td>
  </tr>
  <?php foreach($roll as $value){ ?>
  <tr>
    <td width="154" valign="top"><p><?=tglshort($value->datetime);?></p></td>
    <td width="177" valign="top"><p>
      <?=koderoll($master->tahun,$value->datetime,$value->pm,$value->no_roll);?>
    </p></td>
    <td width="174" valign="top"><p>
      <?=arrtostr(cariarray($master->jenis,$value->jenis))." ".$value->gsm." GSM ".$value->lebar." CM ".arrtostr(cariarray($master->warna,$value->warna));?>
    </p></td>
    <td width="96" valign="top" align="right"><p>
      <?=number_format($value->berat);?>
    </p></td>
  </tr>
  <?php } ?>
</table>
<br>
<br>
<table border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="223" valign="top"><p align="center"><strong>Dibuat :</strong></p>
      <p align="center"><strong>&nbsp;</strong></p>
      <p align="center"><strong>&nbsp;</strong></p></td>
    <td width="190" valign="top"><p align="center"><strong>Mengetahui :</strong></p>
      <p align="center"><strong>&nbsp;</strong></p>
      <p align="center"><strong>&nbsp;</strong></p></td>
    <td width="203" valign="top"><p align="center"><strong>Disetujui :</strong></p></td>
  </tr>
</table>
</body>