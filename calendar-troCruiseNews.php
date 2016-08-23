<?
define('TRO_ADS',true);
include('init.php');
$db = new pdo_Database(DB_HOST, DB_NAME, DB_USER, DB_PASS);
$insert = INCLUDES_URL.'/troCruiseNews-insert.php';


$addStyleSheet[] = templateAddStyleSheet("//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.10.0/css/bootstrap-select.min.css");
$addStyleSheet[] = templateAddStyleSheet(CSS_URL."/bootstrap-datepicker.min.css");
$addStyleSheet[] = templateAddStyleSheet(CSS_URL."/fullcalendar.css");
$addStyleSheet[] = templateAddStyleSheet(CSS_URL."/dashboard.css");
$addScript[] = templateAddScript("//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.10.0/js/bootstrap-select.min.js");
$addScript[] = templateAddScript(JS_URL."/bootstrap-datepicker.min.js");
$addScript[] = templateAddScript(JS_URL."/moment.min.js");
$addScript[] = templateAddScript(JS_URL."/fullcalendar.min.js");


$pageTitle = "Global Calendar";
include('templates/header-calendar.php');
?>

<div id="fullCalModal" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span> <span class="sr-only">close</span></button>
					<h4 id="modalTitle" class="modal-title"></h4>
				</div>
				<div id="modalBody" class="modal-body">
					<h4>Supplier</h4>   
					<div class="row">
						<div class="col-md-12">
							&nbsp&nbsp&nbsp<input name="supplier" id="supplier" value="" readonly style="border:none">							
						</div>	
					</div>
					
					<h4>Banner Type</h4>   
					<div class="row">
						<div class="col-md-12">							
							&nbsp&nbsp&nbsp<input name="bannerType" id="bannerType" value="" readonly style="border:none">							
						</div>	
					</div>
					
					<h4>Start</h4>   
					<div class="row">
						<div class="col-md-12">							
							&nbsp&nbsp&nbsp<input name="start" id="start" value="" readonly style="border:none">						
						</div>	
					</div>
					
					<h4>End</h4>   
					<div class="row">
						<div class="col-md-12">							
							&nbsp&nbsp&nbsp<input name="end" id="end" value="" readonly style="border:none">							
						</div>	
					</div>
					
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					<button class="btn btn-info"><a id="eventUrl" target="_blank">Edit</a></button>
				</div>
			</div>
		</div>
	</div>


           
	<!--Change different setup here for different sidebar items-->
	<?
		$sql = "select * from supplier order by Name";
		$db->query($sql);
		$db->execute();
		$row=$db->resultset();
		$option_supplier = '';
		$j=0;
		while($j<count($row))
		{
			 $option_supplier .= '<option value = "'.$row[$j]['Name'].'">'.$row[$j]['Name'].'</option>';
			 $j++;
		}
	?>
	<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
	  <h2 class="sub-header">Setup</h2> 
	
	  <div class="row placeholders">
			<div class="col-md-4">
				<div class="input-group">
					<span class="input-group-addon" id="basic-addon1">Supplier</span>
					<select id="supplierName" name ="supplierName" class="form-control selectpicker" aria-describedby="basic-addon1" data-live-search="true">
					<option value="">None - Please Select</option>
					
					<?php echo $option_supplier; ?>
					
					</select>
				</div>
			</div>	
	  </div>
	  
	  <div class="row placeholders">
			<div class="col-md-4">
				<div class="input-group">
					<span class="input-group-addon" id="basic-addon1">Banner Type</span>
						<select id="type" name ="type" data-live-search="true" class="form-control selectpicker" 
								aria-describedby="basic-addon1">
						<option value="">None - Please Select</option>
						<option value="sponsor">Sponsor</option>
						<option value="callout">Call Out</option>
						</select>
				</div>
			</div>	
	  </div>
	  <div class="row placeholders">
			<div  id="sandbox-container">
				<div class="col-md-4">
					<div class="input-group">
						<span class="input-group-addon" id="basic-addon1">Start</span>
						<input type="text" name="startDate" id="startDate" class="form-control"  aria-describedby="basic-addon1">
					</div>
				</div>
				<div class="col-md-4">
					<div class="input-group">
						<span class="input-group-addon" id="basic-addon1">End</span>
						<input type="text" name="endDate" id="endDate" class="form-control"  aria-describedby="basic-addon1">
					</div>
				</div>
			</div>
      
      		<div class='col-md-1'>
            	<button class='btn btn-default' id='clear'>Clear</button>
            </div>
      		<script>
      			$('#clear').click(function(){
                	s='';
                	e='';
                	$('#startDate').val('');
                	$('#endDate').val('');
                	document.getElementById('supplierName').value = '';
                	$('#calendar').fullCalendar('removeEvents',1);
                });
      		</script>
	  </div>
	  
	  <?

	$edit = 'troCruiseNews-edit.php';
	$getBookingInfo = 'troCruiseNews-getBookingInfo.php';
	$getID = 'getSupplierIDbyName.php';
	$getDate = 'calendar-troCruiseNews-getDate.php';
	$name = 'supplierName';
	$data = "'supplierID='+ id +'&bannerType=' + $('#type').val();";
	$htmlItem = 'supplierName';
	//for popover html elements
	$item_0 = 'supplier';
	$item_1 = 'bannerType';
	$item_2 = 'start';
	$item_3 = 'end';
	$item_4 = '';
	$item_5 = '';
	$item_6 = '';
	include('templates/global_calendar.php');
	?>
<?
include('templates/footer-calendar.php');
?>