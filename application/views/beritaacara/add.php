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
if(!isset($beritaacara->pm)){
	$beritaacara->pm=0;
}
if(!isset($beritaacara->jenis)){
	$beritaacara->jenis=0;
}
if(!isset($beritaacara->warna)){
	$beritaacara->warna=0;
}
if(!isset($beritaacara->kepala)){
	$beritaacara->kepala=0;
}
if(!isset($beritaacara->mutu)){
	$beritaacara->mutu=1;
}
if(!isset($beritaacara->shift)){
	$beritaacara->shift=1;
}
if(!isset($beritaacara->src)){
	$beritaacara->src=0;
}
if(!isset($beritaacara->export)){
	$beritaacara->export=0;
}
if(!isset($beritaacara->masalah)){
	$beritaacara->masalah=array();
}


?>

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Berita Acara
        <small>Terlambat Input Roll</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Berita Acara</li>
        <li class="active">Add</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
 <form action="<?=base_url('beritaacara/save');?>" method="post" id="formroll">
    <!-- Small boxes (Stat box) -->
    <!-- /.row -->
    <!-- Main row -->
    <div class="row">
        <!-- Left col -->
        <section class="col-lg-8 connectedSortable">
        <div class="alert alert-success" id="success-alert" style="display:none">
    		<button type="button" class="close" data-dismiss="alert">x</button>
    		Data Berhasil Disimpan.
		</div>
        <div class="alert alert-danger" id="alert-danger" style="display:none">
    		<button type="button" class="close" data-dismiss="alert">x</button>
    		Data Gagal Disimpan, hubungi Administrator.
		</div>
        <div class="box box-info">
                <div class="box-header">
                  <i class="ion ion-clipboard"></i>
                  <h3 class="box-title">Last added data</h3>
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
                    <h3 class="box-title">Input Data Roll</h3>
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
                      			<input name="datetime" type="text" class="form-control pull-right" id="datetime" value="<?=(isset($beritaacara->datetime))?$beritaacara->datetime:'';?>"/>
                    			</div>
                            </div>
    <div class="col-xs-2">
                            	<label>PM</label>
                  				<select class="form-control" name="pm" id="pm">
                    				<option value="1" <?php echo set_select('pm',$beritaacara->pm, ($beritaacara->pm==1));?>>1</option>
                    				<option value="2" <?php echo set_select('pm',$beritaacara->pm, ($beritaacara->pm==2));?>>2</option>
                    				<option value="0"  <?php echo set_select('pm',$beritaacara->pm, ($beritaacara->pm==0));?>>&nbsp;</option>
                 		 		</select>
                         	</div>
                			<div class="col-xs-2">
                            <label>Jenis</label>
                 			<select class="form-control" name="jenis" id="jenis">
							<?php  
							foreach($jenis as $detailjenis){
							?>
      							<option value=<?=$detailjenis->id; ?> <?=set_select('jenis',$detailjenis->id, ($beritaacara->jenis==$detailjenis->id));?>><?=$detailjenis->nama; ?></option>
      <?php } ?>            </select>
                			</div>
                			<div class="col-xs-2">
                            <label>GSM</label>
                  				<input name="gsm" type="text" class="form-control" id="gsm" value="<?=(isset($beritaacara->gsm))?$beritaacara->gsm:'';?>" placeholder="GSM..."/>
                			</div>
                			<div class="col-xs-2">
                            <label>CM</label>
                            <input name="lebar" type="text" class="form-control" id="lebar" value="<?=(isset($beritaacara->lebar))?$beritaacara->lebar:'';?>" placeholder="CM..."/>
                			</div>
              			</div>
                     </div>
                     <div class="form-group">
                        <div class="row">
                        	<div class="col-xs-2">
                            <label>Shift</label>
                    			<select class="form-control" name="shift" id="shift">
                    				<option value="1" <?=set_select('shift',$beritaacara->shift, ($beritaacara->shift==1));?>>1</option>
                    				<option value="2" <?=set_select('shift',$beritaacara->shift, ($beritaacara->shift==2));?>>2</option>
                    				<option value="3" <?=set_select('shift',$beritaacara->shift, ($beritaacara->shift==3));?>>3</option>
                 		 		</select>
                            </div>
                            <div class="col-xs-3">
                            <label>K.A. Shift</label>
                    			<select class="form-control" name="kepala" id="kepala">
                    		<?php  
							foreach($kepala as $detailkepala){
							?>
      							<option value=<?=$detailkepala->id; ?> <?php echo set_select('kepala',$detailkepala->id, ($beritaacara->kepala==$detailkepala->id));?>><?=$detailkepala->nama; ?></option>
      <?php } ?>            
                 		 		</select>
                            </div>
                            <div class="col-xs-2">
                            <label>Jumbo</label>
                  				<input name="no_jumbo" type="text" class="form-control" id="no_jumbo" value="<?=(isset($beritaacara->no_jumbo))?$beritaacara->no_jumbo:'';?>" placeholder="Jumbo"/>
                			</div>
                            <div class="col-xs-2">
                            <label>Roll</label>
                  				<input name="no_roll" type="text" class="form-control" id="no_roll" value="<?=(isset($beritaacara->no_roll))?$beritaacara->no_roll:'';?>" placeholder="Kode"/>
                			</div>
                            <div class="col-xs-2">
                            <label>Lebar</label>
                  				<input name="lebar_2" type="text" class="form-control" id="lebar_2" value="<?=(isset($beritaacara->lebar_2))?$beritaacara->lebar_2:'';?>" placeholder="CM"/>
                			</div>
                        </div>
                
                	</div>
                  <div class="form-group">
                        <div class="row">
                        	<div class="col-xs-2">
                            	<label>Diameter</label>
                  				<input name="diameter" type="text" class="form-control" id="diameter" value="<?=(isset($beritaacara->diameter))?$beritaacara->diameter:'';?>" placeholder="Diameter"/>
                            </div>
                          <div class="col-xs-3">
                           	<label>Berat</label>
               				  <input name="berat" type="text" class="form-control" id="berat" value="<?=(isset($beritaacara->berat))?$beritaacara->berat:'';?>" placeholder="Kg"/>
                            </div>
                            <div class="col-xs-2">
                           	  <label>Mutu</label>
                  				<select name="mutu" class="form-control" id="mutu">
                    				<option value="1" <?php echo set_select('mutu',$beritaacara->mutu, ($beritaacara->mutu==1));?>>Q1</option>
                    				<option value="2" <?php echo set_select('mutu',$beritaacara->mutu, ($beritaacara->mutu==2));?>>Q2</option>
                    				<option value="3" <?php echo set_select('mutu',$beritaacara->mutu, ($beritaacara->mutu==3));?>>Q3</option>
                                    <option value="4" <?php echo set_select('mutu',$beritaacara->mutu, ($beritaacara->mutu==4));?>>Q4</option>
                 		 		</select>
                            </div>
                          <div class="col-xs-2">
                           	<label>GSM</label>
               				  <input name="gsm_2" type="text" class="form-control" id="gsm_2" value="<?=(isset($beritaacara->gsm_2))?$beritaacara->gsm_2:'';?>" placeholder="GSM"/>
                            </div>
                          <div class="col-xs-2">
                           	<label>RCT</label>
               				  <input name="rct" type="text" class="form-control" id="rct" value="<?=(isset($beritaacara->rct))?$beritaacara->rct:'';?>" placeholder="RCT"/>
                            </div>
                            
                        </div>
                        
                  </div>
                  <div class="form-group">
                        <div class="row">
                       	  <div class="col-xs-2">
                           	<label>BST</label>
               				  <input name="bst" type="text" class="form-control" id="bst" value="<?=(isset($beritaacara->bst))?$beritaacara->bst:'';?>" placeholder="BST"/>
                            </div>
                          <div class="col-xs-2">
                           	<label>COBB</label>
               				  <input name="cobb" type="text" class="form-control" id="cobb" value="<?=(isset($beritaacara->cobb))?gabungslash1($beritaacara->cobb):'';?>"  data-inputmask='"mask": "99/99"' data-mask />
                            </div>
                          <div class="col-xs-2">
                           	<label>Smooth</label>
               				  <input name="smooth" type="text" class="form-control" id="smooth" value="<?=(isset($beritaacara->smooth))?gabungslash3($beritaacara->smooth):'';?>"  data-inputmask='"mask": "9999/9999"' data-mask/>
                            </div>
                          <div class="col-xs-2">
                           	<label>Putus</label>
               				  <input name="putus" type="text" class="form-control" id="putus" value="<?=(isset($beritaacara->putus))?$beritaacara->putus:'';?>" placeholder="Putus"/>
                            </div>
                            <div class="col-xs-3">
                            	<label>Warna</label>
                  				<select class="form-control" name="warna" id="warna">
                    				<?php  
							foreach($warna as $detailwarna){
							?>
      							<option value=<?=$detailwarna->id; ?> <?php echo set_select('jenis',$detailwarna->id, ($beritaacara->warna==$detailwarna->id));?>><?=$detailwarna->nama; ?></option>
      <?php } ?>
                 		 		</select>
                            </div>
                            
                        </div>
                  </div>
                  <div class="form-group">
                  	<div class="row">
                  		<div class="col-xs-2">
                            	<!-- checkbox -->
                            	<input name="src" type="checkbox" id="src" value="1"  <?=set_checkbox('src', '1', ($beritaacara->src==1)); ?>/>
                             	<!-- todo text -->
                       	  <label>SRC</label>
                            	
                      </div>
                         <div class="col-xs-2">
                         		<!-- checkbox -->
                            	<input type="checkbox" value="1" name="export" id="export <?=set_checkbox('export', '1', ($beritaacara->export==1)); ?>"/>
                            	<!-- todo text -->
                       	   <label>Export</label>
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                  <label>Keterangan</label>
                            <textarea name="keterangan" class="textarea" id="keterangan" style="width: 100%; height: 125px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;" placeholder="Message"><?=(isset($beritaacara->keterangan))?$beritaacara->keterangan:'';?>
                            </textarea>
                      </div>
                       <!-- Loading (remove the following to stop the loading)-->
            <div class="overlay" style="display:none">
              <i class="fa fa-refresh fa-spin"></i>
            </div>
            <!-- end loading -->
                </div>
                <div class="box-footer clearfix">
                    <button class="pull-right btn btn-default" id="sendEmail">Simpan <i class="fa fa-save"></i></button>
                    <input name="id" type="hidden" id="id" value="<?=(isset($beritaacara->id))?$beritaacara->id:0;?>" />
                </div>
            </div>
                </div>
                
       
            </div><!-- /.nav-tabs-custom -->


			<!-- /.box -->
            <!-- TO DO List --><!-- /.box -->

            <!-- quick email widget -->
          

        </section><!-- /.Left col -->
        <!-- right col (We are only adding the ID to make the widgets sortable)-->
        <section class="col-lg-4 connectedSortable">

            <!-- Map box --><!-- /.box -->

            <!-- solid sales graph -->
          <div class="box box-danger">
                <div class="box-header">
                    <i class="fa fa-warning"></i>
                    <h3 class="box-title">Masalah</h3>
              </div><!-- /.box-header -->
                <div class="box-body">
                    <ul class="todo-list">
                    <?php  
							foreach($masalah as $detailmasalah){
							?>
                        <li>
                            <!-- checkbox -->
                            <input type="checkbox" value="<?=$detailmasalah->id;?>" name="masalah[]" <?php 
							
                            	foreach($beritaacara->masalah as $m){
									 if($m==$detailmasalah->id){
										 echo " checked";
										 }
									}
								
									
							?>/>
                            <!-- todo text -->
                            <span class="text"><?=$detailmasalah->nama;?></span>
                        </li>
                       <?php
							}
					   ?>
                    </ul>
                  	
              </div>
              
          </div>
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
        //Datemask dd/mm/yyyy
        //$("#datemask").inputmask("dd/mm/yyyy", {"placeholder": "dd/mm/yyyy"});
		$("[data-mask]").inputmask();
		$(".textarea").wysihtml5();
		$('#datetime').datepicker({
      		autoclose: true,
			format: 'yyyy-mm-dd'
    	});

	// Bind to the submit event of our form
	$("#formroll").submit(function(event){
		if($('#datetime').val()==""){
			alert('lengkapi data');
			return false;
		}
		if($('#jenis').val()==0){
			alert('lengkapi data');
			return false;
		}
		if($('#pm').val()==0){
			alert('lengkapi data');
			return false;
		}
		if($('#gsm').val()==""){
			alert('lengkapi data');
			return false;
		}
		if($('#lebar').val()==""){
			alert('lengkapi data');
			return false;
		}
		if($('#shift').val()==0){
			alert('lengkapi data');
			return false;
		}
		if($('#kepala').val()==0){
			alert('lengkapi data');
			return false;
		}
		if($('#no_jumbo').val()==""){
			alert('lengkapi data');
			return false;
		}
		if($('#no_roll').val()==""){
			alert('lengkapi data');
			return false;
		}
		if($('#lebar_2').val()==""){
			alert('lengkapi data');
			return false;
		}
		if($('#diameter').val()==""){
			alert('lengkapi data');
			return false;
		}
		if($('#berat').val()==""){
			alert('lengkapi data');
			return false;
		}
		/*
		if($("[name='masalah[]']:checked").length>=0 && $('#mutu').val()==1){
			alert('Q1 tidak boleh ada masalah');
			return false;
		}
		*/
    event.preventDefault();
    var $form = $(this);
    var serializedData = $form.serialize();
    request = $.ajax({
        url: $form.attr('action'),
        type: $form.attr('method'),
        data: serializedData,
		dataType: 'html',
		beforeSend:function(){
        	$(".overlay").show();
    	},
    	success:function(result){
			$(".overlay").hide();
			$("#success-alert").fadeTo(2000, 500).slideUp(500, function(){
               $("#success-alert").slideUp(1000);
            });
			
			var win = window.open('<?=site_url('beritaacara/cetaklabel/');?>/'+result, '_blank');
				if (win) {
    				//Browser has allowed it to be opened
   					win.focus();
				} else {
    				//Browser has blocked it
    				alert('Please allow popups for this website');
				} 
			
    	},
		error:function(data){
			$(".overlay").hide();
			alert(data.toSource());
			//alert(respon.toSource());
        	//alert(result);
			
    	},
    	complete:function(){
        	
    	}
    });

    
	//return false;
	});
});
</script>
<?php
$this->load->view('template/foot');
?>