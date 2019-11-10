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
        <li class="active">Kemasan</li>
        <li class="active">Tambah</li>
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
                    <h3 class="box-title">Tambah Kemasan</h3>
                </div>
                <div class="box-body">
                        <div class="form-group">
                        <div class="row">
                       	  <div class="col-xs-4">Nama
                       	    <div class="input-group">
               			  <input type="text" class="form-control pull-right" id="nama" name="nama" value="<?php echo (isset($kemasan->nama))?$kemasan->nama:'';?>"  placeholder="Nama Kemasan..."/>
               			  </div>
                            </div>
                       	  <div class="col-xs-4">
                            Rumus Induk Volume
                              <div class="input-group">
                 			<select class="form-control" name="id_rumus" id="id_rumus">
                            <option value=0>&nbsp;</option>
   							 <?php  
							foreach($rumus as $value){
							?>
   							  <option value=<?=$value->id;?> <?=set_select('material',$kemasan->id_rumus, ($kemasan->id_rumus==$value->id));?>><?=$value->nama;?></option>
                              <?php 
							}
							?>
                			</select>
                            </div>
               			  </div>
    						<div class="col-xs-12">
                      		<label>Keterangan</label>
                             <textarea name="keterangan" class="textarea" id="keterangan" style="width: 100%; height: 125px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;" placeholder="Keterangan..."><?php echo (isset($kemasan->keterangan))?$kemasan->keterangan:'';?></textarea>
                             <input name="id" type="hidden" id="id" value="<?php echo (isset($kemasan->id))?$kemasan->id:0;?>" />
                          <input name="refer" type="hidden" id="refer" value="<?=(!empty($refer))?$this->agent->referrer():'';?>" />
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
                  <button class="pull-right btn btn-default" id="sendEmail">Simpan <i class="fa fa-save"></i></button>
                </div>
            </div>
                </div>
                
       
            </div><!-- /.nav-tabs-custom -->


			<!-- /.box -->
            <!-- TO DO List --><!-- /.box -->

            <!-- quick email widget -->
          

        </section>
        <section class="col-lg-3 connectedSortable">

           <div class="nav-tabs-custom">
                <!-- Tabs within a box -->
                <div class="tab-content">
                    <!-- Morris chart - Sales -->
                  <div class="box box-primary">
                <div class="box-header">
                    <i class="fa fa-pencil-square-o"></i>
                    <h3 class="box-title">Rumus</h3>
                </div>
                <div class="box-body">
                        <div class="form-group">
                        <div id="example"></div>
                     </div>
                     
                  
                  
                  
                       <!-- Loading (remove the following to stop the loading)-->
            <div class="overlay" style="display:none">
              <i class="fa fa-refresh fa-spin"></i>
            </div>
            <!-- end loading -->
                </div>
                <div class="box-footer clearfix">
                </div>
            </div>
                </div>
                
       
            </div>
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
	var hasil;
	
	var data = <?=$std;?>,
		container = document.getElementById('example'),
		hot;
		hot = new Handsontable(container, {
			data: data,
			//minSpareRows: 21,
			colHeaders: true,
			//contextMenu: true,
			colHeaders: ['Simbol','Nama','Value'],
			columns: [
						{
						  data: 'simbol',
						  readOnly: true
						},
						{
						  data: 'namarumus',
						  readOnly: true
						},
						{
						  data: 'value'
						}
					]
			
		});
	 function bindDumpButton() {
	  	
		  Handsontable.dom.addEvent(document.body, 'click', function (e) {
	  
			var element = e.target || e.srcElement;
	  
			if (element.nodeName == "BUTTON" && element.name == 'dump') {
			  var name = element.getAttribute('data-dump');
			  var instance = element.getAttribute('data-instance');
			  var hot = window[instance];
			  console.log('data of ' + name, hot.getData());
			}
		  });
		  
		  $( "#id_rumus" ).change(function() {
				var url="<?=base_url('wip/master');?>" + "/" + $( "#id_rumus" ).val();
				$.get( url, function( text ) {
					hasil = text;
					hot.loadData(hasil);
					hot.render();
					//alert(hasil);
				});
			});
		}
  		bindDumpButton();
		
		$("#formkemasan").submit(function(event){
			
			if($('#nama').val()==""){
				alert('Nama Tidak Boleh Kosong');
				return false;
			}
		event.preventDefault();
		var $form = $(this);
		var serializedData = $form.serialize();
		var kirimdata = serializedData+"&array="+JSON.stringify(hot.getData());
		
		request = $.ajax({
			url: $form.attr('action'),
			type: $form.attr('method'),
			data: kirimdata,
			dataType: 'html',
			beforeSend:function(){
				$(".overlay").show();
			},
			success:function(result){
				$(".overlay").hide();
				//alert(result);
				$("#success-alert").fadeTo(2000, 500).slideUp(500, function(){
				   $("#success-alert").slideUp(1000);
				});
				var redirect;
				redirect=$("#refer").val();
				if(redirect!=''){
				    window.location = redirect;
				}
			},
			error:function(data){
				$(".overlay").hide();
				alert(data.toSource());
				
			},
			complete:function(){
				$(".overlay").hide();
			}
		});
		
		//alert(JSON.stringify(hot.getData()));
		return false;
		//alert(kirimdata);
		
		});
	
});
</script>
<?php
$this->load->view('template/foot');
?>