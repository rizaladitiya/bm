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
  <link data-jsfiddle="common" rel="stylesheet" media="screen" href="<?php echo base_url('assets/handsontable-master/dist/handsontable.full.css');?>">

<?php
$this->load->view('template/topbar');
$this->load->view('template/sidebar');
?>

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Data Wiring<small></small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Instrument</li>
        <li class="active">Wiring</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <!-- Small boxes (Stat box) -->
    <!-- /.row -->
    <!-- Main row -->
    <div class="row">
    	<div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Data Wiring</h3>
			
              
            </div>
            <!-- /.box-header -->
			<div class="box box-primary">
                <div class="box-header">
                    <i class="fa fa-pencil-square-o"></i>
                    <h3 class="box-title">Periode</h3>
                </div>
                <div class="box-body">
                    <div class="form-group">
						<div class="row">
							<div class="col-xs-2">
                                <label>Mesin</label>
                                <select class="form-control" name="machine" id="machine">
                                    <option value=0>-- Pilih Mesin --</option>
                                    <?php  
                                    foreach($machine as $value){
                                    ?>
                                    <option value=<?=$value->id;?>><?=$value->name;?></option>
                                    <?php 
                                    }
                                    ?>
                                </select>
                            </div>
							<div class="col-xs-2">
                                <label>PLC</label>
                                <select class="form-control" name="plc" id="plc">
                                  <option value=""></option>
                                </select>
                            </div>
							<div class="col-xs-2">
                                <label>Instrument</label>
                                <select class="form-control" name="instrument" id="instrument">
                                  <option value=""></option>
                                </select>
                            </div>
						</div>
					</div>
				</div>

			</div>

            <div class="box-body">
                <div class="box-tools">
                <div class="input-group input-group-sm hidden-xs" style="width: 150px;">
                  <input type="text" name="table_search" class="form-control pull-right" placeholder="Search" id="search_field">

                  
                </div>
              </div>
	               <div id="example"></div>
            </div>
            <!-- /.box-body -->
            <div class="box-footer clearfix">
                
                    <button class="pull-right btn btn-default" id="simpan">Simpan <i class="fa fa-save"></i></button>
                </div>
          </div>
          <!-- /.box -->
        </div>
    </div><!-- /.row (main row) -->

</section><!-- /.content -->
<!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Loading......<i class="fa fa-refresh fa-spin"></i></h4>
        </div>
        <div class="modal-body">
          <h2 align="center"><i class="fa fa-refresh fa-spin"></i></h2>
        </div>
        <div class="modal-footer">
        </div>
      </div>
      
    </div>
  </div>


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
<!-- Handsontable -->
  <script data-jsfiddle="common" src='<?php echo base_url('assets/handsontable-master/dist/handsontable.full.js');?>'></script>



<script type="text/javascript">
$(function () {
    var idmachine;
    var idplc;
    var hot;
    $("#machine").change(function() {
        idmachine = $("#machine").val();
        $("#myModal").modal();
        // Documentation on getJSON: http://api.jquery.com/jQuery.getJSON/
        $.ajax({
            url: '<?=base_url('wiring/jsonplcbymachine');?>',
            type: 'post',
            data: {"machine": idmachine},
            dataType: 'jsonp',
            success: function( data, textStatus, jQxhr ){
                $('#plc').empty();
				$('#instrument').empty();
               // alert(JSON.stringify(data));
               $("#plc").append("<option value=0>-- Pilih PLC --</option>");
                $.each(data, function(key,value){
                    // Create and append the new options into the select list
                    $("#plc").append("<option value="+value.id+">"+value.brand+"</option>");
                    //alert(value.id);
                });
                $("#myModal").modal('hide');
            },
            error: function( jqXhr, textStatus, errorThrown ){
                console.log( errorThrown );
                alert(errorThrown);
            }
        });
    });
	$("#instrument").change(function() {
        idplc = $("#plc").val();
		idinstrument = $("#instrument").val();
        $("#myModal").modal();
         $.ajax({
            url: '<?=base_url('wiring/jsonwiringfromplcinstrument');?>',
            type: 'post',
            data: {"plc": idplc,
					"instrument": idinstrument},
            dataType: 'jsonp',
            success: function( data, textStatus, jQxhr ){
                //alert(JSON.stringify(data));
				//alert(idinstrument);
                generateTable(data);
                $("#myModal").modal('hide');
            },
            error: function( jqXhr, textStatus, errorThrown ){
                console.log( errorThrown );
                alert(errorThrown);
            }
        });
        
    });
    $("#plc").change(function() {
        idplc = $("#plc").val();
        $("#myModal").modal();
         $.ajax({
            url: '<?=base_url('wiring/jsonwiringfromplc');?>',
            type: 'post',
            data: {"plc": idplc},
            dataType: 'jsonp',
            success: function( data, textStatus, jQxhr ){
                //alert(JSON.stringify(data));
                generateTable(data);
                $("#myModal").modal('hide');
            },
            error: function( jqXhr, textStatus, errorThrown ){
                console.log( errorThrown );
                alert(errorThrown);
            }
        });
		$.ajax({
            url: '<?=base_url('wiring/jsoninstrumentbyplc');?>',
            type: 'post',
            data: {"plc": idplc},
            dataType: 'jsonp',
            success: function( data, textStatus, jQxhr ){
               $('#instrument').empty();
               $("#instrument").append("<option value=0>-- Pilih Instrument --</option>");
                $.each(data, function(key,value){
                    // Create and append the new options into the select list
                    $("#instrument").append("<option value="+value.instrument+">"+value.instrument+"</option>");
                    //alert(value.id);
                });
                //$("#myModal").modal('hide');
            },
            error: function( jqXhr, textStatus, errorThrown ){
                console.log( errorThrown );
                alert(errorThrown);
            }
        });
                //generateTable();
    });
    function generateTable(isi) {
    var
    data = isi,
    container = document.getElementById('example'),
    searchFiled = document.getElementById('search_field');
    //hot.destroy();
    hot = new Handsontable(container, {
        data: data,
        //minSpareRows: 21,
        colHeaders: true,
		rowHeaders: true,
        width: '100%',
        height: 800,
        search: true,
        contextMenu: ['copy', 'cut'],
        hiddenColumns: {
            columns: [0],
            indicators: false
        },
        colHeaders: [   
                    'id',
                    'Devicetag',
                    'Description',
                    'Card Type',
                    'Signal Type',
                    'Address',
                    'Panel',
                    'Signal',
                    'Relay',
                    'Terminal',
                    'Terminal2',
                    'JB',
                    'JB Term',
                    'Checked',
                    'User'
                    ],
		colWidths: [
					{},
					105,
					300,
					50,
					50,
					50,
					100,
					50,
					50,
					50,
					50,
					50,
					100,
					100
					
		],
        columns: [
                {readOnly: true},
                {}, 
                {},
                {},
                {},
                {readOnly: true},
                {},
                {},
                {},
                {readOnly: true},
                {readOnly: true},
                {},
                {},
                {readOnly: true},
                {readOnly: true}
              ],

        licenseKey: 'non-commercial-and-evaluation',

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
        
          Handsontable.dom.addEvent(searchFiled, 'keyup', function (event) {
            var search = hot.getPlugin('search');
            var queryResult = search.query(this.value);
          
            console.log(queryResult);
            hot.render();
          });

        }

    bindDumpButton();
    }

    $("#simpan").click(function() {

        $("#myModal").modal();
        //alert(JSON.stringify(hot.getData()));
        $.ajax({
            url: '<?=base_url('wiring/updatehandsontable');?>',
            type: 'post',
            data: {"data": JSON.stringify(hot.getData())},
            dataType: 'text',
            success: function( data, textStatus, jQxhr ){
                //alert(JSON.stringify(data));
                //alert(data);
                $('#myModal').modal('hide');
            },
            error: function( jqXhr, textStatus, errorThrown ){
                console.log( errorThrown );
                alert(errorThrown);
            }
        });
    });
	
});
</script>
<?php
$this->load->view('template/foot');
?>