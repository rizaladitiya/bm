<?php
$this->load->view('template/head');
?>

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

<?php
$this->load->view('template/topbar');
$this->load->view('template/sidebar');
if(!isset($grinding->material)){
	$grinding->material=1;
}

?>

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Print Grinding</h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li>Grinding</li>
        <li class="active">Print</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
 <form action="<?=base_url('grinding/add2');?>" method="post" id="formgrinding">
    <!-- Small boxes (Stat box) -->
    <!-- /.row -->
    <!-- Main row -->
    <div class="row">
        <!-- Left col -->
        <section class="col-lg-12 connectedSortable" style="display:none" id="grafik">
        	<div class="box box-info">
                <div class="box-header">
                  <h3 class="box-title">Grinding Report</h3>
                </div>
                <div class="box-body chart-responsive">
                  <div class="chart" id="line-chart" style="height: 300px;"></div>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            <!-- Custom tabs (Charts with tabs)-->
        </section>
        <section class="col-lg-5 connectedSortable">
            <div class="nav-tabs-custom">
                <!-- Tabs within a box -->
                <div class="tab-content no-padding">
                    <!-- Morris chart - Sales -->
                  <div class="box box-primary">
                <div class="box-header">
                    <i class="fa fa-pencil-square-o"></i>
                    <h3 class="box-title">Parameter</h3>
                </div>
                <div class="box-body">
                        <div class="form-group">
                        <div class="row">
               	  		  <div class="col-xs-4">
                           	<label>Crowning</label>
                   			<input type="text" class="form-control pull-right" id="crown" name="crown" placeholder="mm..." data-inputmask='"mask": "9.999"' data-mask value=<?=(!empty($this->input->post('crown')))?$this->input->post('crown'):'';?> />
                           	</div>
                            <div class="col-xs-2">
                            <label>Material</label>
                 			<select class="form-control" name="material" id="material">
                            <?php  
							foreach($material as $value){
							?>
   							  <option value=<?=$value->id;?> <?=set_select('material',$grinding->material, ($grinding->material==$value->id));?>><?=$value->nama;?></option>
                              <?php 
							}
							?>
                			</select>
                			</div>
              			</div>
                     </div>
                     
                  
                  
                  
                       <!-- Loading (remove the following to stop the loading)-->
            <div class="overlay" style="display:none">
              <i class="fa fa-refresh fa-spin"></i>
            </div>
            <!-- end loading -->
                </div>
                <div class="box-footer clearfix">
                  <button class="pull-right btn btn-default" id="sendEmail">Print <i class="fa fa-print"></i></button>
                    <input name="id" type="hidden" id="id" value="<?=(isset($grinding->id))?$grinding->id:0;?>" />
                </div>
            </div>
                </div>
                
       
            </div><!-- /.nav-tabs-custom -->


			<!-- /.box -->
            <!-- TO DO List --><!-- /.box -->

            <!-- quick email widget -->
          

        </section><!-- /.Left col -->
        <!-- right col (We are only adding the ID to make the widgets sortable)-->
        <section class="col-lg-5 connectedSortable">

           <div class="nav-tabs-custom">
                <!-- Tabs within a box -->
                <div class="tab-content no-padding">
                    <!-- Morris chart - Sales -->
                  <div class="box box-primary">
                <div class="box-header">
                    <i class="fa fa-pencil-square-o"></i>
                    <h3 class="box-title">Point</h3>
                </div>
                <div class="box-body">
                        <div class="form-group">
                        <?php
						$nomer=10;
						for($i=0;$i<=20;$i++){
						 ?>
                        	<div class="row">
                       	  		<div class="col-xs-4">
                              	<label><?=$nomer;?></label>
                      			<input type="text" class="form-control pull-right" id="measured[]" name="measured[]" placeholder="mm..." data-inputmask='"mask": "9.999"' data-mask  value=<?=(!empty($this->input->post('measured')))?$this->input->post('measured')[$i]:'';?>/>
                            	</div>
              				</div>
                        <?php 
						if($i==9){
							$nomer="C";
						}else if($i<9){
							$nomer--;
						}else{
							if($nomer=="C"){
								$nomer=0;
							}
							$nomer++;
						}
						}
						?>	
                     </div>
                     
                  
                  
                  
                       <!-- Loading (remove the following to stop the loading)-->
            <div class="overlay" style="display:none">
              <i class="fa fa-refresh fa-spin"></i>
            </div>
            <!-- end loading -->
                </div>
                <div class="box-footer clearfix">
                  <button class="pull-right btn btn-default" id="sendEmail">Print <i class="fa fa-print"></i></button>
                    <input name="id" type="hidden" id="id" value="<?=(isset($grinding->id))?$grinding->id:0;?>" />
                </div>
            </div>
                </div>
                
       
            </div>
        </section><!-- right col -->
    </div><!-- /.row (main row) -->

                    </form>
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
	$("[data-mask]").inputmask();
		<?php 
		if(!empty($this->input->post('measured'))){
			$data = $this->input->post('measured');
			$crown = (float) $this->input->post('crown');
			$range= 0.025;
			$point=array('10','9','8','7','6','5','4','3','2','1','C','1','2','3','4','5','6','7','8','9','10');
			$standart=array(-1,-0.8298,-0.6699,-0.5226,-0.3904,
							-0.2748,-0.1778,-0.1009,-0.0451,-0.0112,
							0.0000,
							-0.0112,-0.0451,-0.1009,-0.1778,-0.2748,
							-0.3904,-0.5226,-0.6699,-0.8298,-1);
			$chart_data = '';
			foreach($data as $index => $value)
			{
				
				$target=(float) $standart[$index]*$crown;
				$targetmin=(float) ($standart[$index]*$crown)-($range/2);
				$targetmax=(float) ($standart[$index]*$crown)+($range/2);
				$chart_data .= "{ point:'".$point[$index]."', standart:'".$target."', min:'".$targetmin."', max:'".$targetmax."', actual:'".-round($value,3)."'}, ";
			}
			$chart_data = substr($chart_data, 0, -2);
			
		?>
		
		$('#grafik').show();
		
	// LINE CHART
        var line = new Morris.Line({
          element: 'line-chart',
          resize: true,
          data: [<?php echo $chart_data; ?>],
          xkey: 'point',
          ykeys: ['standart', 'min', 'max', 'actual'],
          labels: ['standart', 'min', 'max', 'actual'],
          hideHover: 'auto',
		  smooth: true,
		  ymax: 0.03,
		  ymin: -<?=$crown+($range/2)?>,
		  parseTime:false,
		  horizontal: true,
		  axes: 'x',
		  pointSize: 0,
		  lineWidth: 1,
		  lineColors: ['#06FF00', '#888','#555', '#FF002A'],
		  //xLabelAngle: 90
		  //xLabelFormat: formatX,
        });
	<?php } ?>
});
</script>
<?php
//echo $chart_data;
$this->load->view('template/foot');
?>