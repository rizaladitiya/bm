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
?>

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        PO Lebih dari 3 Bulan</h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">PO</li>
        <li class="active">Lebih 3 Bulan</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
 
    <!-- Small boxes (Stat box) -->
    <!-- /.row -->
    <!-- Main row -->
    <div class="row">
      <section class="col-lg-4 connectedSortable">
        <div class="box box-info">
                <div class="box-header">
                  <i class="ion ion-clipboard"></i>
                  <h3 class="box-title">Pilih Tanggal</h3>
                </div>
                <div class="box-body">
                	<div class="form-group">
                        <div class="row">
                       	  <div class="col-xs-6">
                          <form action="<?=base_url('po/tigabulan');?>" method="post" id="formroll">
                            <label>Tanggal</label>
               				  <input name="tgl" type="text" class="form-control" id="tgl" value="<?php echo (isset($tgl))?$tgl:'';?>" placeholder="Tanggal..."/>
                            
                            	<button class="pull-right btn btn-default" id="sendEmail">Cari <i class="fa fa-search"></i></button>
                           </form>
                                </div>
                        </div>
                    </div>
                </div>
        </div>
      </section>
    </div>
    <div class="row">
    	<div class="col-xs-12">
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
              <table width="100%" border="0" cellspacing="0" cellpadding="0" class="table table-hover">
  <tr>
    <td>Tanggal</td>
    <td>PO</td>
    <td>Customer</td>
    <td>PM</td>
    <td>Status</td>
    <td>Jenis</td>
    <td>GSM</td>
    <td>Jumlah</td>
    <td>Sisa</td>
    <td>Harga</td>
    </tr>
    <?php 
	if(isset($po)){
	foreach ($po as $value) { ?>
  <tr>
    <td><?=$value->tanggal;?></td>
    <td><?=$value->po;?></td>
    <td><?=$value->customer;?></td>
    <td><?=$value->pm;?></td>
    <td><?=$value->status;?></td>
    <td><?=$value->jenis;?></td>
    <td><?=$value->gsm;?></td>
    <td align="right"><?=number_format($value->jumlah);?></td>
    <td align="right"><?=number_format($value->sisa);?></td>
    <td align="right"><?=number_format($value->harga);?></td>
    </tr>
    <?php }} ?>
    
</table>

        </div>
            <!-- /.box-body -->
            
      </div>
          <!-- /.box -->
        </div>
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
	$('#tgl').datepicker({
      		autoclose: true,
			format: 'yyyy-mm-dd'
    	});
});
</script>




<?php
$this->load->view('template/foot');
?>