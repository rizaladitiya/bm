<?php
$this->load->view('template/head');
?>
<style type="text/css" media="print">
@media print {
   @page :left {
margin: 0.1cm;
}

@page :right {
margin: 0.1cm;
}
@page :top {
margin: 0.1cm;
}
}
</style>
<!--tambahkan custom css disini-->
<!-- iCheck -->
<link href="<?php echo base_url('assets/AdminLTE-2.0.5/plugins/iCheck/flat/blue.css') ?>" rel="stylesheet" type="text/css" />
<!-- Morris chart -->
<link href="<?php echo base_url('assets/AdminLTE-2.0.5/plugins/morris/morris.css') ?>" rel="stylesheet" type="text/css" />
<!-- jvectormap -->
<link href="<?php echo base_url('assets/AdminLTE-2.0.5/plugins/jvectormap/jquery-jvectormap-1.2.2.css') ?>" rel="stylesheet" type="text/css" />
<!-- Date Picker -->
<link href="<?php echo base_url('assets/AdminLTE-2.0.5/plugins/datepicker/datepicker3.css') ?>" rel="stylesheet" type="text/css" />
<!-- Daterange picker -->
<link href="<?php echo base_url('assets/AdminLTE-2.0.5/plugins/daterangepicker/daterangepicker-bs3.css') ?>" rel="stylesheet" type="text/css" />
<!-- bootstrap wysihtml5 - text editor -->
<link href="<?php echo base_url('assets/AdminLTE-2.0.5/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css') ?>" rel="stylesheet" type="text/css" />




<!-- Main content -->
<section class="content">
    <!-- Small boxes (Stat box) -->
    <!-- /.row -->
    <!-- Main row -->
    <div class="row">
        <!-- Left col -->
        <section class="col-xs-12 connectedSortable" style="display:none" id="grafik">
        	<div class="box">
                <div class="box-header">
                  <h3 class="box-title"><img src="<?=base_url('assets/cetak_clip_image002.jpg');?>" /></h3>
                </div>
                <div class="box-body chart-responsive">
                  <div class="chart" id="line-chart" style="height: 250px; width:900px"></div>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            <!-- Custom tabs (Charts with tabs)-->
        </section>
    </div>
    <div class="row">
<section class="col-xs-12 connectedSortable">
            <div class="col-xs-8">
           	  <table width="100%" border="1" cellspacing="0" cellpadding="0">
  <tr>
    <td width="40%">Company</td>
    <td width="59%">:&nbsp;PT. Buana Megah Paper Mills</td>
  </tr>
  <tr>
    <td>Customer</td>
    <td>:&nbsp;<?=$grinding->customer;?></td>
  </tr>
  <tr>
    <td>Roll Type &amp; Location</td>
    <td>:&nbsp;<?=$grinding->location;?></td>
  </tr>
  <tr>
    <td>Roll Number</td>
    <td>:&nbsp;<?=$grinding->number;?></td>
  </tr>
  <tr>
    <td>Before Grinding Diameter</td>
    <td>:&nbsp;<?=$grinding->before;?> mm</td>
  </tr>
  <tr>
    <td>After Grinding Diameter</td>
    
    <td>:&nbsp;<?=$grinding->after;?>
 mm</td>
  </tr>
  <tr>
    <td>Face Length</td>
    
    <td>:&nbsp;<?=$grinding->face_length;?>
 mm</td>
  </tr>
  <tr>
    <td>Crowning &amp; Sin Curve</td>
    
    <td>:&nbsp;<?=$grinding->crowning;?>
 mm</td>
  </tr>
  <tr>
    <td>Cover Material</td>
    
    <td>:&nbsp;<?=$grinding->material;?></td>
  </tr>
  <tr>
    <td>Hardness</td>
    
    <td>:&nbsp;<?=$grinding->hardness;?></td>
  </tr>
  <tr>
    <td>Surface Roughness</td>
    
    <td>:&nbsp;<?=$grinding->surface;?></td>
  </tr>
  <tr>
    <td>Roundness</td>
    
    <td>:&nbsp;<?=$grinding->roundness;?>
 mm</td>
  </tr>
  <tr>
    <td>Tolerance</td>
    <td>:&nbsp;<?=$grinding->tolerance;?></td>
  </tr>
  <tr>
    <td>Date Start Grinding</td>
    
    <td>:&nbsp;<?=date('d-M-y',strtotime($grinding->date_start));?></td>
  </tr>
  <tr>
    <td>Date Finish Grinding</td>
    
    <td>:&nbsp;<?=date('d-M-y',strtotime($grinding->date_finish));?></td>
  </tr>
  <tr>
    <td>Operator</td>
    
    <td>:&nbsp;<?=$grinding->operator;?></td>
  </tr>
  <tr>
    <td>Remarks</td>
    
    <td>:&nbsp;<?=$grinding->remark;?></td>
  </tr>
</table>
<br />
<div class="col-xs-4">
Reported By
<br />
<br />
<br />
<br />
Suhartono
</div>
    </div>
            <div class="col-xs-4">
              <table width="100%" border="1" cellspacing="0" cellpadding="0">
                <tr align="center">
                  <td>Point</td>
                  <td>Target</td>
                  <td>Before</td>
                  <td>After</td>
                </tr>
                <?php foreach($isitabel as $key=>$value){ ?>
                <tr>
                  <td align="center"><?=$value->point;?></td>
                  <td align="center"><?=number_format(round($standard[$key]*$grinding->crowning,3),3);?></td>
                  <td align="center"><?=number_format($value->before,3);?></td>
                  <td align="center"><?=number_format($value->after,3);?></td>
                </tr>
                <?php } ?>
                
              </table>
            	
</div>
      </section>
	</div>
</section><!-- /.content -->


<?php
$this->load->view('template/js');
?>

<!--tambahkan custom js disini-->
<!-- jQuery UI 1.11.2 -->
<script src="<?php echo base_url('assets/js/jquery-ui.min.js') ?>" type="text/javascript"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
    $.widget.bridge('uibutton', $.ui.button);
</script>
<!-- Morris.js charts -->
<script src="<?php echo base_url('assets/js/raphael-min.js') ?>"></script>
<script src="<?php echo base_url('assets/AdminLTE-2.0.5/plugins/morris/morris.min.js') ?>" type="text/javascript"></script>
<!-- Sparkline -->
<script src="<?php echo base_url('assets/AdminLTE-2.0.5/plugins/sparkline/jquery.sparkline.min.js') ?>" type="text/javascript"></script>
<!-- jvectormap -->
<script src="<?php echo base_url('assets/AdminLTE-2.0.5/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js') ?>" type="text/javascript"></script>
<script src="<?php echo base_url('assets/AdminLTE-2.0.5/plugins/jvectormap/jquery-jvectormap-world-mill-en.js') ?>" type="text/javascript"></script>
<!-- jQuery Knob Chart -->
<script src="<?php echo base_url('assets/AdminLTE-2.0.5/plugins/knob/jquery.knob.js') ?>" type="text/javascript"></script>
<!-- daterangepicker -->
<script src="<?php echo base_url('assets/AdminLTE-2.0.5/plugins/daterangepicker/daterangepicker.js') ?>" type="text/javascript"></script>
<!-- datepicker -->
<script src="<?php echo base_url('assets/AdminLTE-2.0.5/plugins/datepicker/bootstrap-datepicker.js') ?>" type="text/javascript"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="<?php echo base_url('assets/AdminLTE-2.0.5/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js') ?>" type="text/javascript"></script>
<!-- iCheck -->
<script src="<?php echo base_url('assets/AdminLTE-2.0.5/plugins/iCheck/icheck.min.js') ?>" type="text/javascript"></script>



<script type="text/javascript">

$(function () {
		<?php 
		if(!empty($actual)){
			$crown = (float) $grinding->crowning;
			$range = (float) $grinding->tolerance/1000;
			$chart_data = '';
			foreach($actual as $index => $value)
			{
				
				$target=(float) round($standard[$index]*$crown,3);
				$targetmin=(float) round(($standard[$index]*$crown)-($range/2),3);
				$targetmax=(float) round(($standard[$index]*$crown)+($range/2),3);
				$chart_data .= "{ point:'".$point[$index]."', standard:'".$target."', min:'".$targetmin."', max:'".$targetmax."', actual:'".round($value,3)."'}, ";
			}
			$chart_data = substr($chart_data, 0, -2);
			
		?>
		
		$('#grafik').show();
		
	// LINE CHART
        var line = new Morris.Line({
          element: 'line-chart',
          resize: false,
          data: [<?php echo $chart_data; ?>],
          xkey: 'point',
          ykeys: ['standard', 'min', 'max', 'actual'],
          labels: ['standard', 'min', 'max', 'actual'],
          hideHover: 'auto',
		  smooth: true,
		  ymax: 0.000001,
		  ymin: -<?=$crown?>,
		  parseTime:false,
		  horizontal: true,
		  //axes: 'x',
		  grid: false,
		  pointSize: 0,
		  //onlyIntegers: true,
		  lineWidth: 1,
		  lineColors: ['#06FF00', '#888','#555', '#FF002A'],
		  //gridIntegers: true,
		  grid:true,
		  yLabelFormat: function (y) {
			var parts = parseFloat(y.toString()).toFixed(3);
			return parts;
			//return round(parts,2);
			}
		  //xLabelAngle: 90
		  //xLabelFormat: formatX,
        });
	<?php } ?>
});
</script>
<?php
//echo $chart_data;
//$this->load->view('template/foot');
?>