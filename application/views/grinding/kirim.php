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
    Kirim Roll Reject</h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Reject</li>
        <li class="active">Kirim</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
 <form action="<?=base_url('reject/savekirim');?>" method="post" id="formroll">
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
                    <h3 class="box-title">Kirim Data</h3>
                </div>
                <div class="box-body">
                        <div class="form-group">
                        <div class="row">
                        <div class="col-xs-6">
                       	  <label>Customer</label>
                  				<select class="form-control" name="customer" id="customer">
                                <?php foreach($customer as $value){?>
                    				<option value="<?=$value->id;?>" <?=isset($reject->customer)?set_select('customer',$reject->customer, ($reject->customer==$value->id)):'';?>><?=$value->nama;?></option>
                                <?php } ?>
                 		 		</select>
                       	  </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-4">
                            <label>PO</label>
                    			<div class="input-group">
                      			<input name="po" type="text" class="form-control pull-right" id="po" value="<?=(isset($reject->po))?$reject->po:'';?>"  placeholder="Ketik Nomer PO disini....."/>
                    			</div>
                        </div>
                        </div>
                        <div class="row">
                       	  <div class="col-xs-4">
                            <label>Tanggal</label>
                    			<div class="input-group">
                     				<div class="input-group-addon">
                        				<i class="fa fa-calendar"></i>
                      				</div>
                      			<input name="tanggal" type="text" class="form-control pull-right" id="tanggal" value="<?=(isset($reject->tanggal))?$reject->tanggal:'';?>"/>
                    			</div>
                            </div>
    
              			</div>
                     </div>
                     
                     
                  <div class="form-group">
                  <label>Keterangan</label>
                  <textarea name="keterangan" class="textarea" id="keterangan" style="width: 100%; height: 125px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;" placeholder="Ketik Keterangan disini....."><?=(isset($reject->keterangan))?$reject->keterangan:'';?>
                            </textarea>
                  </div>
                      <div class="form-group">
                      <h3 align="center">Nomer Roll</h3>
                       <div class="row">
                       <div class="overlay" style="display:none">
              				<i class="fa fa-refresh fa-spin"></i>
            			</div>
                       		<div id="listroll" class="col-xs-10">
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
    <td><?=koderoll2($master->tahun,$value->datetime,$value->pm,$value->roll);?></td>
    <td><?=arrtostr(cariarray($master->jenis,$value->jenis))." ".$value->gsm." GSM ".$value->lebar." CM";?></td>
    <td align="right"><?=number_format($value->berat);?></td>
  </tr>
 <?php } ?>
</tbody>
</table>
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
                    <button class="pull-right btn btn-default" id="sendEmail">Kirim <i class="fa fa-send"></i></button>
                    <input name="id" type="hidden" id="id" value="<?=(isset($reject->id))?$reject->id:0;?>" />
                    <input name="refer" type="hidden" id="refer" value="<?=(isset($refer))?$refer:'';?>" />
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
		$('#tanggal').datepicker({
      		autoclose: true,
			format: 'yyyy-mm-dd'
    	});
});
</script>
<?php
$this->load->view('template/foot');
?>