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
if(!isset($reject->pm)){
	$reject->pm=0;
}
if(!isset($reject->jenis)){
	$reject->jenis=0;
}
if(!isset($reject->warna)){
	$reject->warna=0;
}


?>

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Input Laporan Kerja</h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Checklist</li>
        <li class="active">Add Laporan</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
 <form action="<?=base_url('reject/save');?>" method="post" id="formroll">
    <!-- Small boxes (Stat box) -->
    <!-- /.row -->
    <!-- Main row -->
    <div class="row">
        <!-- Left col -->
        <section class="col-lg-7 connectedSortable">
          <!-- Custom tabs (Charts with tabs)-->
      <div class="nav-tabs-custom">
                <!-- Tabs within a box -->
                <div class="tab-content no-padding">
                    <!-- Morris chart - Sales -->
                  <div class="box box-primary">
                <div class="box-header">
                    <i class="fa fa-pencil-square-o"></i>
                    <h3 class="box-title">Input Laporan Kerja</h3>
                </div>
                <div class="box-body">
                        <div class="form-group">
                        <div class="row">
                       	  <div class="col-xs-3">
                            <label>Tanggal</label>
                    			<div class="input-group">
                     				<div class="input-group-addon">
                        				<i class="fa fa-calendar"></i>
                      				</div>
                      			<input type="text" class="form-control pull-right" id="datetime" name="datetime" value="<?php echo (isset($reject->datetime))?$reject->datetime:'';?>"/>
                    			</div>
                          </div>
    <div class="col-xs-2">
                            	<label>Dari</label>
                  				<input type="text" class="form-control pull-right" id="datetime" name="datetime" value="<?php echo (isset($reject->dari))?$reject->dari:'';?>"/>
                       	  </div>
                			<div class="col-xs-2">
                            <label>Hingga</label>
                 			<input type="text" class="form-control pull-right" id="datetime" name="datetime" value="<?php echo (isset($reject->hingga))?$reject->hingga:'';?>"/>
                			</div>
               			  </div>
                        </div>
                     
                  <div class="form-group">
                        <div class="row">
                          <div class="col-xs-3">
                            <label>User</label>
                  				<select class="form-control" name="warna" id="warna">
                    				<?php  
							foreach($warna as $detailwarna){
							?>
      							<option value=<?=$detailwarna->id; ?> <?php echo set_select('warna',$detailwarna->id, ($reject->warna==$detailwarna->id));?>><?=$detailwarna->nama; ?></option>
      <?php } ?>
                 		 		</select>
                            </div>
                        </div>
                  </div>
                  
                  <div class="form-group">
                  	<div class="row">
                  		<div class="col-xs-2">
                   	  <!-- checkbox --></div>
</div>
                  </div>
                  <div class="form-group">
                  <label>Masalah</label>
                            <textarea name="masalah" class="textarea" id="masalah" style="width: 100%; height: 125px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;" placeholder="Message"><?php echo (isset($reject->masalah))?$reject->masalah:'';?></textarea>
                  </div>
                  <div class="form-group">
                  <label>Koreksi</label>
                            <textarea name="koreksi" class="textarea" id="koreksi" style="width: 100%; height: 125px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;" placeholder="Message"><?php echo (isset($reject->koreksi))?$reject->koreksi:'';?></textarea>
                  </div>
                  <div class="form-group">
                  <label>Keterangan</label>
                            <textarea name="keterangan" class="textarea" id="keterangan" style="width: 100%; height: 125px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;" placeholder="Message"><?php echo (isset($reject->keterangan))?$reject->keterangan:'';?></textarea>
                  </div>
                       <!-- Loading (remove the following to stop the loading)-->
            <div class="overlay" style="display:none">
              <i class="fa fa-refresh fa-spin"></i>
            </div>
            <!-- end loading -->
                </div>
                <div class="box-footer clearfix">
                  <button class="pull-right btn btn-default" id="sendEmail">Simpan <i class="fa fa-save"></i></button>
                    <input name="id" type="hidden" id="id" value="<?=(isset($reject->id))?$reject->id:0;?>" />
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

            <!-- Map box --><!-- /.box -->

            <!-- solid sales graph -->
          
          <!-- /.box -->

            <!-- Calendar -->
            <!-- /.box -->

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
		$(".textarea").wysihtml5();
		$('#datetime').datepicker({
      		autoclose: true,
			format: 'yyyy-mm-dd'
    	});
	function ambilJSON(url){
    var url = url;
	var trHTML = '';
    $.getJSON(url)
        .done(function(data) {
			$("#tabellast > tbody").empty();
			$.each(data, function(i, data2){
				trHTML += "<tr>";
				trHTML += "<td>" + data2.datetime + "</td>";
				trHTML += "<td>" + data2.kode + "</td>";
				trHTML += "<td>" + data2.pm + "</td>";
				trHTML += "<td>" + data2.jenis + "</td>";
				trHTML += "<td>" + data2.gsm + "</td>";
				trHTML += "<td>" + data2.lebar + "</td>";
				trHTML += "<td>" + data2.berat + "</td>";
				trHTML += "<td>" + data2.warna + "</td>";
				trHTML += "<td>" + data2.keterangan + "</td>";
				trHTML += "</tr>";
			});  
			$("#tabellast > tbody").append(trHTML);  
        });
	}
	
	// Bind to the submit event of our form
	$("#formroll").submit(function(event){
    event.preventDefault();
    var $form = $(this);
    var serializedData = $form.serialize();
    request = $.ajax({
        url: $form.attr('action'),
        type: $form.attr('method'),
        data: serializedData,
		beforeSend:function(){
        	$(".overlay").show();
    	},
    	complete:function(){
        	$(".overlay").hide();
    	},
    	success:function(result){
			$(".overlay").hide();
			ambilJSON('<?=base_url('reject/last');?>');
    	}
    });

    
	//return false;
	});
	ambilJSON('<?=base_url('reject/last');?>');
});
</script>
<?php
$this->load->view('template/foot');
?>