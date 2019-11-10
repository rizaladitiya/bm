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
<!-- Handsontable -->
  <link data-jsfiddle="common" rel="stylesheet" media="screen" href="<?php echo base_url('assets/handsontable/dist/handsontable.full.css');?>">

<?php
$this->load->view('template/topbar');
$this->load->view('template/sidebar');
if(!isset($grinding->material)){
	$grinding->material='Rubber';
}


?>

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Add Grinding</h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Grinding</li>
        <li class="active">Add</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
 <form action="<?=base_url('grinding/save');?>" method="post" id="formgrinding">
    <!-- Small boxes (Stat box) -->
    <!-- /.row -->
    <!-- Main row -->
    <div class="row">
        <!-- Left col -->
        <section class="col-lg-12 connectedSortable">
        <div class="box box-info">
                <div class="box-header">
                  <i class="ion ion-clipboard"></i>
                  <h3 class="box-title">Last added data</h3>
                </div>
                <div class="box-body">
                  <table id="tabellast" class="table table-hover">
                  	 <thead>
                     	<tr>
                     	<th>Tanggal</th>
                        <th>Customer</th>
                        <th>Roll Location</th>
                        <th>Roll Number</th>
                        <th>Operator</th>
                        </tr>
                     </thead>
                     <tbody>
                     </tbody>
                  </table>
            </div><!-- /.box-body -->
              </div>
            </section>
            <section class="col-lg-9 connectedSortable">
            <!-- Custom tabs (Charts with tabs)-->
            <div class="nav-tabs-custom">
                <!-- Tabs within a box -->
                <div class="tab-content no-padding">
                    <!-- Morris chart - Sales -->
                  <div class="box box-primary">
                <div class="box-header">
                    <i class="fa fa-pencil-square-o"></i>
                    <h3 class="box-title">Add Grinding</h3>
                </div>
                <div class="box-body">
                        <div class="form-group">
                        <div class="row">
                       	  <div class="col-xs-3">
                            <label>Date Start</label>
                    			<div class="input-group">
                     				<div class="input-group-addon">
                        				<i class="fa fa-calendar"></i>
                      				</div>
                      			<input type="text" class="form-control pull-right" id="date_start" name="date_start" value="<?php echo (isset($grinding->date_start))?$grinding->date_start:'';?>"/>
                    			</div>
                            </div>
                            <div class="col-xs-3">
                          <label>Date Finish</label>
                    			<div class="input-group">
                   				  <div class="input-group-addon">
                        				<i class="fa fa-calendar"></i>
                      				</div>
                      			<input type="text" class="form-control pull-right" id="date_finish" name="date_finish" value="<?php echo (isset($grinding->date_finish))?$grinding->date_finish:'';?>"/>
                    			</div>
                            </div>
    						<div class="col-xs-6">
                            	<label>Customer</label>
                  				<input type="text" class="form-control pull-right" id="customer" name="customer" value="<?php echo (isset($grinding->customer))?$grinding->customer:'';?>" placeholder="Customer..."/>
                         	</div>
                			
               			  
              			</div>
                     </div>
                     
                  <div class="form-group">
                        <div class="row">
                        <div class="col-xs-3">
                            <label>Location</label>
               				  <input name="location" type="text" class="form-control" id="location" value="<?php echo (isset($grinding->location))?$grinding->location:'';?>" placeholder="Location..."/>
                        </div>
                        <div class="col-xs-2">
                        	<label>Roll Number</label>
                        		<input name="number" type="text" class="form-control" id="number" value="<?php echo (isset($grinding->number))?$grinding->number:'';?>" placeholder="Roll Number..."/>
                        </div>
                        <div class="col-xs-3">
                       	  <label>Diameter Before</label>
                        		<input name="before" type="text" class="form-control" id="before" value="<?php echo (isset($grinding->before))?$grinding->before:'';?>" placeholder="mm..."/>
                        </div>
                        <div class="col-xs-3">
                       	  <label>Diameter After</label>
                        		<input name="after" type="text" class="form-control" id="after" value="<?php echo (isset($grinding->after))?$grinding->after:'';?>" placeholder="mm..."/>
                        </div>
                     </div>
                  </div>
                  <div class="form-group">
                  	<div class="row">
                        
               			  <div class="col-xs-2"><label>Face Length </label>
               			    <input name="face_length" type="text" class="form-control" id="face_length" value="<?php echo (isset($grinding->face_length))?$grinding->face_length:'';?>" placeholder="Face Length..." data-inputmask='"mask": "9999"' data-mask/>
               			  </div>
                        <div class="col-xs-2">
                          <label>Crowning</label>
                          <input name="crowning" type="text" class="form-control" id="crowning" value="<?php echo (isset($grinding->crowning))?$grinding->crowning:'';?>" placeholder="mm..." data-inputmask='"mask": "9.999"' data-mask/>
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
                      <div class="col-xs-2">
                        <label>Tolerance</label>
                        <input name="tolerance" type="text" class="form-control" id="tolerance" value="<?php echo (isset($grinding->tolerance))?$grinding->tolerance:'';?>" placeholder="micron..."/>
                        </div>
                        	<div class="col-xs-2">
                            <label>Hardness</label>
                            <input name="hardness" type="text" class="form-control" id="hardness" value="<?php echo (isset($grinding->hardness))?$grinding->hardness:'';?>" placeholder="Hardness..."/>
                        </div>
                        
                        </div>
                  </div>
                  <div class="form-group">
                  	<div class="row">
                  		<div class="col-xs-3">
                            <label>Surface</label>
                            <input name="surface" type="text" class="form-control" id="surface" value="<?php echo (isset($grinding->surface))?$grinding->surface:'';?>" placeholder="Surface..."/>
                        </div>
                  <div class="col-xs-2">
                            <label>Roundness</label>
                            
                            <input name="roundness" type="text" class="form-control" id="roundness" value="<?php echo (isset($grinding->roundness))?$grinding->roundness:'';?>" placeholder="Roundness..." data-inputmask='"mask": "9.99"' data-mask/>
                      </div>
                    <div class="col-xs-3">
                      <label>Operator</label>
                       <input name="operator" type="text" class="form-control" id="operator" value="<?php echo (isset($grinding->operator))?$grinding->operator:'';?>" placeholder="Operator..."/>
                    </div>
                  	</div>
                  </div>
                  <div class="form-group">
                      <div class="row">
                      	<div class="col-xs-12">
                      		<label>Remark</label>
                             <textarea name="remark" class="textarea" id="remark" style="width: 100%; height: 125px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;" placeholder="Remark..."><?php echo (isset($grinding->remark))?$grinding->remark:'';?></textarea>
                             <input name="id" type="hidden" id="id" value="<?=(isset($grinding->id))?$grinding->id:0;?>" />
                          <input name="refer" type="hidden" id="refer" value="<?=(!empty($this->agent->referrer()))?$this->agent->referrer():'';?>" />
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
                  <button class="pull-right btn btn-default" id="sendEmail">Simpan <i class="fa fa-save"></i></button>
                    
                </div>
            </div>
                </div>
                
       
            </div><!-- /.nav-tabs-custom -->


			<!-- /.box -->
            <!-- TO DO List --><!-- /.box -->

            <!-- quick email widget -->
          

        </section><!-- /.Left col -->
        <!-- right col (We are only adding the ID to make the widgets sortable)-->
        <section class="col-lg-3 connectedSortable">

           <div class="nav-tabs-custom">
                <!-- Tabs within a box -->
                <div class="tab-content">
                    <!-- Morris chart - Sales -->
                  <div class="box box-primary">
                <div class="box-header">
                    <i class="fa fa-pencil-square-o"></i>
                    <h3 class="box-title">Point</h3>
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

  <script data-jsfiddle="common" src='<?php echo base_url('assets/handsontable/dist/handsontable.full.js');?>'></script>



<script type="text/javascript">
$(function () {
		$("[data-mask]").inputmask();
		$(".textarea").wysihtml5();
		$('#date_start,#date_finish').datepicker({
      		autoclose: true,
			format: 'yyyy-mm-dd'
    	});
		var
		data = <?=$std;?>,
		container = document.getElementById('example'),
		hot;
		hot = new Handsontable(container, {
			data: data,
			//minSpareRows: 21,
			colHeaders: true,
			//contextMenu: true,
			colHeaders: ['Point','Before','After']
		});
  		// Bind to the submit event of our form
		$("#formgrinding").submit(function(event){
			/*
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
			if($("[name='masalah[]']:checked").length>=0 && $('#mutu').val()==1){
				alert('Q1 tidak boleh ada masalah');
				return false;
			}
			*/
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
				ambilJSON('<?=base_url('grinding/last');?>');
			},
			error:function(data){
				$(".overlay").hide();
				alert(data.toSource());
				
			},
			complete:function(){
			ambilJSON('<?=base_url('grinding/last');?>');	
			}
		});
		
		//alert(kirimdata);
		
		//return false;
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
		}
  		bindDumpButton();
		ambilJSON('<?=base_url('grinding/last');?>');	
	function ambilJSON(url){
    var url = url;
	var trHTML = '';
    $.getJSON(url)
        .done(function(data) {
			$("#tabellast > tbody").empty();
			$.each(data, function(i, data2){
				trHTML += "<tr>";
				trHTML += "<td>" + data2.date_start + "</td>";
				trHTML += "<td>" + data2.customer + "</td>";
				trHTML += "<td>" + data2.location + "</td>";
				trHTML += "<td>" + data2.number + "</td>";
				trHTML += "<td>" + data2.operator + "</td>";
				trHTML += "</tr>";
			});  
			$("#tabellast > tbody").append(trHTML);  
        });
	}	 
});
</script>
<?php
$this->load->view('template/foot');
?>