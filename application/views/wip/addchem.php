<?php
$this->load->view('template/head');
?>

<!--tambahkan custom css disini-->
<!-- iCheck -->
<link href="<?php echo base_url('assets/AdminLTE-2.0.5/plugins/iCheck/flat/blue.css') ?>" rel="stylesheet" type="text/css" />
<!-- Morris chart -->
<link href="<?php echo base_url('assets/AdminLTE-2.0.5/plugins/morris/morris.css') ?>" rel="stylesheet" type="text/css" />

<!-- Date Picker -->
<link href="<?php echo base_url('assets/AdminLTE-2.0.5/plugins/datepicker/datepicker3.css') ?>" rel="stylesheet" type="text/css" />
<!-- Daterange picker -->
<link href="<?php echo base_url('assets/AdminLTE-2.0.5/plugins/daterangepicker/daterangepicker-bs3.css') ?>" rel="stylesheet" type="text/css" />
<!-- bootstrap wysihtml5 - text editor -->
<link href="<?php echo base_url('assets/AdminLTE-2.0.5/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css') ?>" rel="stylesheet" type="text/css" />
<link data-jsfiddle="common" rel="stylesheet" media="screen" href="<?php echo base_url('assets/handsontable/dist/handsontable.full.css');?>">

<?php
$this->load->view('template/topbar');
$this->load->view('template/sidebar');
if(!isset($kemasan->id_rumus)){
	$kemasan->id_rumus='';
}
$refer=$this->agent->referrer();

?>

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>Kemasan</h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">WIP</li>
        <li class="active">Chemical</li>
        <li class="active">Add</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
 <form action="<?=base_url('wip/savemaster');?>" method="post" id="formkemasan">
    <!-- Small boxes (Stat box) -->
    <!-- /.row -->
    <!-- Main row -->
    <div class="row">
        <!-- Left col -->
        <section class="col-lg-8 connectedSortable">
        <div class="box box-info">
                <div class="box-header">
                  <i class="ion ion-clipboard"></i>
                  <h3 class="box-title"><?php ?></h3>
                </div>
                <div class="box-body">
                </div><!-- /.box-body -->
              </div>
            <!-- Custom tabs (Charts with tabs)-->
            <div class="nav-tabs-custom">
                <!-- Tabs within a box -->
                <div class="tab-content no-padding">
                    <!-- Morris chart - Sales -->
                  <div class="box box-primary">
                <div class="box-header">
                    <i class="fa fa-pencil-square-o"></i>
                    <h3 class="box-title">Tambah Chemical WIP</h3>
                </div>
                <div class="box-body">
                        <div class="form-group">
                        <div class="row">
                       	  <div class="col-xs-4">Kelompok
                       	    <div class="input-group">
                       	      <select class="form-control" name="kelompok" id="kelompok">
               			    <option value="0">&nbsp;</option>
               			    <?php  
							foreach($rumus as $value){
							?>
               			    <option value="<?=$value->id;?>" <?=set_select('material',$kemasan->id_rumus, ($kemasan->id_rumus==$value->id));?>>
               			      <?=$value->nama;?>
           			        </option>
               			    <?php 
							}
							?>
             			    </select>
                       	    </div>
                            </div>
                       	  <div class="col-xs-4">Chemical
                       	    <div class="input-group">
                 			<select class="form-control" name="chemical" id="chemical">
                            <option value=0>&nbsp;</option>
   							 <?php  
							foreach($rumus as $value){
							?>
   							  <option value=<?=$value->id;?> <?=set_select('material',$kemasan->id_rumus, ($kemasan->id_rumus==$value->id));?>><?=$value->nama;?></option>
                              <?php 
							}
							?>
                			</select>
                            
                      		<input name="id" type="hidden" id="id" value="<?php echo (isset($kemasan->id))?$kemasan->id:0;?>" />
                          <input name="refer" type="hidden" id="refer" value="<?=(!empty($refer))?$this->agent->referrer():'';?>" />
                            </div>
               			  </div>
                        </div>
                        </div>
                        <div class="form-group">
                          <div class="row"> </div>
                  </div>
                       <!-- Loading (remove the following to stop the loading)-->
            <div class="overlay" style="display:none">
              <i class="fa fa-refresh fa-spin"></i>
            </div>
            <!-- end loading -->
                </div>
                <div class="box-footer clearfix">
                  <button class="pull-right btn btn-default" id="sendEmail">Add<i class="fa fa-save"></i></button>
                </div>
            </div>
                </div>
                
       
            </div><!-- /.nav-tabs-custom -->


			<!-- /.box -->
            <!-- TO DO List --><!-- /.box -->

            <!-- quick email widget -->
          

        </section>
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

<!-- daterangepicker -->
<script src="<?php echo base_url('assets/AdminLTE-2.0.5/plugins/daterangepicker/daterangepicker.js') ?>" type="text/javascript"></script>
<!-- datepicker -->
<script src="<?php echo base_url('assets/AdminLTE-2.0.5/plugins/datepicker/bootstrap-datepicker.js') ?>" type="text/javascript"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="<?php echo base_url('assets/AdminLTE-2.0.5/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js') ?>" type="text/javascript"></script>
<!-- iCheck -->
<script src="<?php echo base_url('assets/AdminLTE-2.0.5/plugins/iCheck/icheck.min.js') ?>" type="text/javascript"></script>
<script data-jsfiddle="common" src='<?php echo base_url('assets/handsontable/dist/handsontable.full.js');?>'></script>



<script type="text/javascript">
$(function () {
	
});
</script>
<?php
$this->load->view('template/foot');
?>