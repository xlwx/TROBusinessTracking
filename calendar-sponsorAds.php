<?
define('TRO_ADS',true);
include('init.php');
$db = new pdo_Database(DB_HOST, DB_NAME, DB_USER, DB_PASS);


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
					<h4>Supplier Name</h4>   
					<div class="row">
						<div class="col-md-12">	
							&nbsp&nbsp&nbsp<input name="supplier" id="supplier" value="" readonly style="border:none">				
						</div>	
					</div>
					
					<h4>Sales Member</h4>   
					<div class="row">
						<div class="col-md-12">
							&nbsp&nbsp&nbsp<input name="salesMember" id="salesMember" value="" readonly style="border:none">							
						</div>	
					</div>
					
					<h4>Inventory Unit</h4>   
					<div class="row">
						<div class="col-md-12">							
							&nbsp&nbsp&nbsp<input name="inventoryUnit" id="inventoryUnit" value="" readonly style="border:none">							
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
					
                	<h4>Size</h4>   
					<div class="row">
						<div class="col-md-12">							
							&nbsp&nbsp&nbsp<input name="sizeShow" id="sizeShow" value="" readonly style="border:none">							
						</div>	
					</div>
                
                	<h4>ID</h4>   
					<div class="row">
						<div class="col-md-12">							
							&nbsp&nbsp&nbsp<input name="idShow" id="idShow" value="" readonly style="border:none">							
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
		//sponsorAds
		$sql = "select * from articles order by Name";
		$db->query($sql);
		$db->execute();
		$row=$db->resultset();
		$option_sponsorAds = '';
		$j=0;
		while($j<count($row))
		{
			 $option_sponsorAds .= '<option value = "'.$row[$j]['Name'].'">'.$row[$j]['Name'].'</option>';
			 $j++;
		}
	?>
	<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
	  <h2 class="sub-header">Setup</h2> 
	
	  <div class="row placeholders">
			<div class="col-md-4">
				<div class="input-group">
					<span class="input-group-addon" id="basic-addon1">Sponsor Ads</span>
					<select id="sponsorName" name ="sponsorName" class="form-control selectpicker" aria-describedby="basic-addon1" data-live-search="true">
					<option value="">None - Please Select</option>
					
					<?php echo $option_sponsorAds; ?>
					
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
                	//document.getElementById('supplierName').value = '';
                	$('#calendar').fullCalendar('removeEvents',1);
                });
      		</script>
	  </div>
    <?
	$edit = 'booking-edit.php';
	$getBookingInfo = 'booking-getBookingInfo.php';
	$getID = 'getSponsorAdsID.php';
	$getDate = 'calendar-sponsorAds-getDate.php';
	$name = 'sponsorName';
	//$id = 'sponsorID';
	$data = "'sponsorID='+id;";
	$htmlItem = 'sponsorName';  // This is the id of the selection item in html
	//for popover html elements
	$item_0 = 'supplier';
	$item_1 = 'salesMember';
	$item_2 = 'inventoryUnit';
	$item_3 = 'start';
	$item_4 = 'end';
	$item_5 = 'sizeShow';
	$item_6 = 'idShow';
	include('templates/global_calendar.php');
	?>
    
	

<?
include('templates/footer-calendar.php');
?>