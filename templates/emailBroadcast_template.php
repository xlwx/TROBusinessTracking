<?
	/*
	//ID
	$ID = '';	
	//Campaign Name
	$campaignName = '';
	//Supplier Name
	$supplierName = '';
	//Broadcast Type
	$broadcastType = '';
	//Server Account
	$serverAccount = '';
	//Broadcast Date
	$broadcastDate = '';
	//Instruction
	$instruction = '';
	
	$action = '';
	$edit = 'emailBroadcast-edit.php';
	$getBookingInfo = 'emailBroadcast-getBookingInfo.php';
	$getDate = 'emailBroadcast-getDate.php';
	
	include('templates/emailBroadcast_template.php');
	
	*/
?>

<script>
$(document).ready(function() {
	
	
		$('#calendar').fullCalendar({
			header: {
				left: 'prev,next today',
				center: 'title',
				right: 'month,basicWeek,basicDay'
			},
			//defaultDate: '2016-06-12',
			editable: true,
			eventLimit: false, // allow 'more' link when too many events 
			eventClick:  function(event, jsEvent, view) {
				//event.url = 'edit.php?campaignName='+event.title;
				$('#modalTitle').html(event.title);
				$('#modalBody').html(event.description);
				$('#eventUrl').attr('href','<?echo $edit;?>?campaignName='+event.title);
				
				var campaignName  = event.title;		
				var data = 'campaignName='+ campaignName;
				//alert(data);
				if(campaignName){              
					$.ajax({
						type: 'GET',
						url: '<? echo AJAX_URL; ?>/<?echo $getBookingInfo;?>',
						data: data,	
						//dataType: 'json',
						success: function(bookingInfo){
							//alert(bookingInfo);  
							var Info = bookingInfo.split('-');
							$('#supplier').val(Info[0]);
							$('#type').val(Info[1]);
							$('#account').val(Info[2]);
							$('#date').val(Info[3]);
							
						}
					});
					
				}			
				
				$('#fullCalModal').modal();
			},
			events: [
				
			]
											 
		});
			
	});
</script>
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
					
					<h4>Broadcast Type</h4>   
					<div class="row">
						<div class="col-md-12">
							&nbsp&nbsp&nbsp<input name="type" id="type" value="" readonly style="border:none">							
						</div>	
					</div>
					
					<h4>Server Account</h4>   
					<div class="row">
						<div class="col-md-12">							
							&nbsp&nbsp&nbsp<input name="account" id="account" value="" readonly style="border:none">							
						</div>	
					</div>
					
					<h4>Broadcast Date</h4>   
					<div class="row">
						<div class="col-md-12">							
							&nbsp&nbsp&nbsp<input name="date" id="date" value="" readonly style="border:none">						
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

	<div class="container">
    <br>
		<div class="page-header">
				<h1><? echo $pageTitle; ?></h1>
		</div>
	<form id="emailBroadcast" method="post" action="<? echo $action; ?>">
		<?php
			//supplier
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
			
		<h3>Campaign Name*</h3>
			<div class="row">
				<div class="col-md-12">
					<div class="input-group">
						<span class="input-group-addon" id="basic-addon1">Campaign Name</span>
						<input type="text" name="campaignName" id="campaignName" class="form-control"  aria-describedby="basic-addon1" value="<?php echo $campaignName; ?>">
					</div>
				</div>
			</div>
			
		<h3>Supplier*</h3>
			<!--Single select-->
			<input type="hidden" id="supplierName" name="supplierName" value="<?php echo $supplierName; ?>">
			<div id="single" class="row" >
				<div class="col-md-12">
					<div class="input-group">
						<span class="input-group-addon" id="basic-addon1">Supplier</span>
						<select id="supplier-single" name ="supplierName_s" class="form-control selectpicker" 
								aria-describedby="basic-addon1" data-live-search="true">
						<option value="">None - Please Select</option>
						
						<?php echo $option_supplier; ?>
						
						</select>
					</div>
				</div>	
			</div>
			<!--Multiple select-->
			<div id="multiple" class="row" hidden>
				<div class="col-md-12">
					<div class="input-group">
						<span class="input-group-addon" id="basic-addon1">Supplier</span>
						<select id="supplier-multiple" name ="supplierName_m" class="form-control selectpicker" 
								aria-describedby="basic-addon1" data-live-search="true" multiple>
						
						<?php echo $option_supplier; ?>
						
						</select>
					</div>
				</div>	
			</div>
		<script>
			$("#supplier-single").change(function(){
					document.getElementById("supplierName").value = $("#supplier-single :selected").text();
					//alert($('#supplier').val());
			});
			$("#supplier-multiple").change(function(){
					var selectSupplier = document.getElementById('supplier-multiple');
					//alert(getSelectValues(selectSupplier));
					document.getElementById("supplierName").value = getSelectValues(selectSupplier);
					//alert($('#supplier').val());
			});
			function getSelectValues(select) {
			  var result = [];
			  var options = select && select.options;
			  var opt;
			  for (var i=0, iLen=options.length; i<iLen; i++) {
				opt = options[i];

				if (opt.selected) {
				  result.push(opt.value || opt.text);
				}
			  }
			  return result;
			}
		</script>
		
		<script >
			document.getElementById('supplier').value = "<?php echo $supplierName; ?>";
		</script>
		
		<h3>Broadcast Type*</h3>
			<div class="row">
				<div class="col-md-12">
					<div class="input-group">
						<span class="input-group-addon" id="basic-addon1">Broadcast Type</span>
						<select id="broadcastType" name ="broadcastType" data-live-search="true" class="form-control selectpicker" 
								aria-describedby="basic-addon1">
						<option value="">None - Please Select</option>
						<option value="Normal">NORMAL</option>
						<option value="WZTN DEDICATED">WZTN DEDICATED</option>
						<option value="WZTN GROUP">WZTN GROUP</option>
						<option value="TRO NOTIFICATION">TRO NOTIFICATION</option>
						<option value="TRO WEBINAR">TRO WEBINAR</option>
						</select>
					</div>
				</div>
				
			</div>
		
		<script>
			document.getElementById('broadcastType').value = "<?php echo $broadcastType; ?>";
			if($("#broadcastType").val() == 'WZTN GROUP'){
				$('#multiple').show();
				$('#single').hide();
				document.getElementById('supplier-multiple').value = "<?php echo $supplierName; ?>";
			}else{
				$('#single').show();
				$('#multiple').hide();
				document.getElementById('supplier-single').value = "<?php echo $supplierName; ?>";
			}
		
			$("#broadcastType").change(function(){
				var select = $("#broadcastType :selected").text();
				if(select == 'WZTN GROUP'){
					$('#multiple').show();
					$('#single').hide();
				}else{
					$('#single').show();
					$('#multiple').hide();
				}	
			});	
		</script>
		
        <h3>Server Account*</h3>
			<div class="row">
				<div class="col-md-12">
					<div class="input-group">
						<span class="input-group-addon" id="basic-addon1">Server Account</span>
						<select id="serverAccount" name ="serverAccount" class="form-control selectpicker" 
								aria-describedby="basic-addon1" data-live-search="true" >
						<option value="">None - Please Select</option>
						<option value="One">One</option>
						<option value="Two">Two</option>
						<option value="Three">Three</option>
						<option value="Four">Four</option>
						<option value="Five">Five</option>
						<option value="Six">Six</option>
						<option value="Seven">Seven</option>
						<option value="Travelgram">Travelgram</option>
						</select>
					</div>
				</div>
				
			</div>
			
		<script >	
                document.getElementById('serverAccount').value = "<?php echo $serverAccount; ?>";
 		</script>
		
		<h3>Broadcast Date*</h3>
			<div class="row" id="sandbox-container">
				<div class="col-md-6">
					<div class="input-group">
						<span class="input-group-addon" id="basic-addon1">Broadcast Date</span>
						<input type="text" name="broadcastDate" id="broadcastDate" class="form-control"  aria-describedby="basic-addon1" value="<?php echo $broadcastDate; ?>">
					</div>
				</div>
			</div>
		<br><br>
		<div id="calendar"></div> 
		
		<script>
			$('#broadcastType').change(function(){
            	$('#calendar').fullCalendar('removeEvents',1);
				var broadcastType  = $("#broadcastType :selected").val();		
				var data = 'broadcastType='+ broadcastType;
				//alert(data);
				if(broadcastType){              
					$.ajax({
						type: "GET",
                    	url: '<? echo AJAX_URL; ?>/<?echo $getDate;?>',
						data: data,	
                    	dataType: 'json',
						success: function(events){
          
							colors = [
									  '#AACC00','#BBCC33','#CCCC66','#DDCC99','#EECCCC','#FFCCFF',
									  '#00FF00','#33AA30','#66BB60','#05CC79','#0cDD8C','#60EEAF',
									  '#0099AA','#0099BB','#0099CC','#0099DD','#0099EE','#0099FF'];									  
														
							for(i=0;i<events.length;i++){
								events[i].editable = false;
								events[i].start = events[i].start + "T23:59:00";
								events[i].color = colors[i%colors.length];
								$('#calendar').fullCalendar('renderEvent',events[i],true);
							}
							 					
							
						}
					});
                    
				}				
				
			});
			
			$('#broadcastDate').change(function () {
		
            	$('#calendar').fullCalendar('removeEvents',0);
				
			
				var res = document.getElementById('broadcastDate').value;
				res = res.split("/");
				var start = res[2] +"-" + res[0] + "-" + res[1];
							
				var newEvent = new Object();
				newEvent.title = document.getElementById('campaignName').value;
				newEvent.start = start;
            	newEvent.id = 0;
            	newEvent.color = 'red';
            	newEvent.editable = false;
				$('#calendar').fullCalendar('renderEvent',newEvent,true);	
			});
		
			$('#sandbox-container input').datepicker({
				multidate: false,
                minDate: 0,                                                                                                            
				calendarWeeks: false,
				autoclose: true,
				todayHighlight: true,
				daysOfWeekDisabled: [0,6]
			});
			
			//check overlapping
        	function isOverlapping(event){
    			var array = $('#calendar').fullCalendar('clientEvents');
				console.log(array);
    			for(i in array){
        			if(array[i].id != event.id){
						var s = new Date(array[i].start);
						var e = new Date(array[i].end);
						var ns = new Date(event.start);
						var ne = new Date(event.end);
						if((s>=ns && s<=ne) || (e>=ns && e<=ne) || (ns>=s && ne<=e)){
							return true;
						}
        			}
    			}
    			return false;
			}
		</script>
		
		<h3>Special Instructions</h3>
			<input type="checkbox" id="addition" onclick="showMe()"> I have it
				    <div class="row" id="instructions-show" style="display:none">
						<div class="col-md-12">
							<div class="input-group">
								<span class="input-group-addon" id="basic-addon1">Instructions</span>
								<textarea type="text" rows="8" name="instruction" class="form-control"  aria-describedby="basic-addon1" ><? echo $instruction; ?></textarea>
							</div>
						</div>
					</div>

		<script>
			function showMe () {  
				var div = document.getElementById("instructions-show");
				if(document.getElementById("addition").checked){
					div.style.display = 'block';
				}else{
					div.style.display = 'none';
				}			
			}
		</script>
		
	
			<br>
        <div>
			<input type="hidden" name="ID"  value="<?php echo $ID; ?>" />
            <input  class="btn btn-lg btn-primary center-block" id="submit-button" type="submit" value="submit" />
        </div>
	</form>
	
	</div>  <!-- end of container-->
	

