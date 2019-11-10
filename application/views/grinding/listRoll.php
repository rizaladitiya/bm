<table width="100%" border="0" cellpadding="0" cellspacing="0" id="tblroll" class="table table-hover">
<thead>
  <tr align="center">
    <th>&nbsp;</th>
    <th>Kode</th>
    <th>Jenis</th>
    <th>Berat</th>
  </tr>
</thead>
<tbody>
<?php foreach($roll as $value){ ?>
  <tr>
    <td><input type="checkbox" name="no_roll[]" value="<?=$value->id;?>" /></td>
    <td><?=koderoll($master->tahun,$value->datetime,$value->pm,$value->no_roll);?></td>
    <td><?=arrtostr(cariarray($master->jenis,$value->jenis))." ".$value->gsm." GSM ".$value->lebar." CM";?></td>
    <td align="right"><?=number_format($value->berat);?></td>
  </tr>
 <?php } ?>
</tbody>
</table>
<div id="hiddenpo" style="display:none"></div>
    <div id="hiddentgl" style="display:none"></div>
<script type="text/javascript">
$(document).ready(function(){
	 
});
</script>