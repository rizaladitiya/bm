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
if(!isset($wip->id_rumus)){
	$wip->id_rumus='';
}
$refer=$this->agent->referrer();

?>

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>Kemasan</h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">WIP</li>
        <li class="active">Add</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
 <form action="<?=base_url('wip/');?>" method="post" id="formkemasan">
    <!-- Small boxes (Stat box) -->
    <!-- /.row -->
    <!-- Main row -->
    <div class="row">
        <!-- Left col -->
        
        <section class="col-lg-3 connectedSortable">

           <div class="nav-tabs-custom">
                <!-- Tabs within a box -->
                <div class="tab-content">
                    <!-- Morris chart - Sales -->
                  <div class="box box-primary">
                <div class="box-header">
                    <i class="fa fa-pencil-square-o"></i>
                    <h3 class="box-title">Add WIP</h3>
                    
                </div>
                <div class="box-body">
                        <div class="form-group">
                        <div class="col-xs-10">
                            <label>Tanggal</label>
               			  <div class="input-group">
               				<div class="input-group-addon">
                        				<i class="fa fa-calendar"></i>
                      				</div>
                      			<input type="text" class="form-control pull-right" id="tanggal" name="tanggal" value="<?php echo (isset($wip->tanggal))?$wip->tanggal:'';?>"/>
                    			</div>
                            </div>
                     
                  <span class="col-xs-10">
                  <input name="id" type="hidden" id="id" value="<?php echo (isset($wip->id))?$wip->id:0;?>" />
                  </span> <span class="col-xs-12">
                  <input name="refer" type="hidden" id="refer" value="<?=(!empty($refer))?$this->agent->referrer():'';?>" />
                  </span>
               	 </div>
                </div>
                 <div class="box-footer clearfix"><br /><br />
                     <button class="pull-right btn btn-default" id="sendEmail">Simpan <i class="fa fa-save"></i></button>
                  </div>
            </div>
                </div>
                
       
            </div>
        </section>
        </div>
        <div class="row">
        <section class="col-lg-8 connectedSortable">

           <div class="nav-tabs-custom">
                <!-- Tabs within a box -->
                <div class="tab-content">
                    <!-- Morris chart - Sales -->
                  <div class="box box-primary">
                <div class="box-header">
                    <i class="fa fa-pencil-square-o"></i>
                    <h3 class="box-title">Data WIP</h3>
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
		$('#tanggal').datepicker({
      		autoclose: true,
			format: 'yyyy-mm-dd'
    	});
	
	var hasil;
	
	var data = <?php echo file_get_contents('http://'.server().'/api/stok/wip');?>,
		container = document.getElementById('example'),
		hot;
		hot = new Handsontable(container, {
			data: data,
			//minSpareRows: 2,
			colHeaders: true,
			//contextMenu: true,
			colHeaders: ['ID','Nama','Kelompok','Satuan','WIP'],
			columns: [
						{
						  data: 'id',
						  readOnly: true
						},
						{
						  data: 'nama',
						  readOnly: true
						},
						{
						  data: 'kelompok',
						  readOnly: true
						},
						{
						  data: 'satuan',
						  readOnly: true
						},
						{
						  data: 'value'
						}
					]
			
		});
		//alert(JSON.stringify(data));
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
		  
		}
  		bindDumpButton();
		
		
		$("#formkemasan").submit(function(event){
			
			if($('#tanggal').val()==""){
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