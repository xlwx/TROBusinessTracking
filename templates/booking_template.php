	
<?

/*	
	//ID
	$ID = '';
	
	//Campaign Name
	$campaignName = '';
	$supplierName = '';
	
	// Inventory Type
	$inventoryType = '';
	
	// Inventory Name
	$unitName = '';
	
	//date
	$startDate = '';
	$endDate = '';
	
	//sales member first name
	$salesMemberName = '';
			
	$action = ;
	$edit = 'booking-edit.php';
	$getBookingInfo = 'booking-getBookingInfo.php';
	$getDate = 'booking-getDate.php';
	
	include('templates/booking_template.php');
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
								$('#salesMemberName').val(Info[1]);
								$('#inventoryUnit').val(Info[2]);
								$('#start').val(Info[3]);
								$('#end').val(Info[4]);
                                $('#sizeShow').val(Info[5]);
								$('#idShow').val(Info[6]);
								
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
					
					<h4>Sales Member</h4>   
					<div class="row">
						<div class="col-md-12">
							&nbsp&nbsp&nbsp<input name="salesMemberName" id="salesMemberName" value="" readonly style="border:none">							
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


	<div class="container">
    <br>
		<div class="page-header">
				<h1><?echo $pageTitle?></h1>
		</div>
	<form id="booking" method="post" action="<? echo $action; ?>">
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
			//bannerAds
			$sql = "select * from bannerAds order by Name";
			$db->query($sql);
			$db->execute();
			$row=$db->resultset();
			$option_bannerAds = '';
			$j=0;
			while($j<count($row))
			{
				 $option_bannerAds .= '<option value = "'.$row[$j]['Name'].'">'.$row[$j]['Name'].'</option>';
				 $j++;
			}
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
			
		<h3>Campaign Name*</h3>
			<div class="row">
				<div class="col-md-12">
					<div class="input-group">
						<span class="input-group-addon" id="basic-addon1">Campaign Name</span>
						<input type="text" name="campaignName" id="campaignName" class="form-control"  aria-describedby="basic-addon1" value="<?php echo $campaignName; ?>">
					</div>
				</div>
			</div>
			
		<h3>Supplier Name*</h3>   
			<div class="row">
				<div class="col-md-12">
					<div class="input-group">
						<span class="input-group-addon" id="basic-addon1">Supplier</span>
						<select id="supplierName" name ="supplierName" class="form-control selectpicker" aria-describedby="basic-addon1" data-live-search="true" >
						<option value="">None - Please Select</option>
						
						<?php echo $option_supplier; ?>
						
						</select>
					</div>
				</div>	
			</div>
                                        
			<script >	
        		document.getElementById('supplierName').value = "<?php echo $supplierName; ?>";
 			</script>
        
		 <?php			
			//salesTeam
			$sql = "select * from salesTeam order by ID";
			$db->query($sql);
			$db->execute();
			$row=$db->resultset();
			$option_salesMember = '';
			$j=0;
			while($j<count($row))
			{
				 $option_salesMember .= '<option value = "'.$row[$j]['FirstName'].'">'.$row[$j]['FirstName'].'</option>';
				 $j++;
			}
		?>
			
		<h3>Sales Member*</h3>
			<div class="row">
				<div class="col-md-12">
					<div class="input-group">
						<span class="input-group-addon" id="basic-addon1">Sales Member</span>
						<select id="salesMember" name ="salesMember" class="form-control selectpicker" aria-describedby="basic-addon1" data-live-search="true" >
						<option value="">None - Please Select</option>
						
						<?php echo $option_salesMember; ?>
						
						</select>
					</div>
				</div>
				
			</div>
		<script >	
                document.getElementById('salesMember').value = "<?php echo $salesMemberName; ?>";
 		</script>
		
		<h3>Inventory Unit*</h3> 
			<div class="row" id="inventoryUnit">
			<input type="radio" name="type" id="bannerAds"  value="Banner Ads">Banner Ads</input>
			<input type="radio" name="type" id="sponsorAds" value="Sponsor Ads">Sponsor Ads</input>
			<input type="hidden" name="inventoryType" id="inventoryType" value="<?php echo $inventoryType; ?>">
			<input type="hidden" id="inventoryName" value="<?echo $unitName;?>">
				<div class="col-md-12">
					<div class="input-group" id="BA" >
						<span class="input-group-addon" id="basic-addon1">Inventory</span>              
						<select name ="inventoryUnit_ba" id ="inventoryUnit_ba" class="form-control selectpicker" aria-describedby="basic-addon1" data-live-search="true">
						<option value="">None - Please Select</option>
						<?php echo $option_bannerAds; ?>
						</select>
					</div>
                
                	<div class="input-group" id="SA">
						<span class="input-group-addon" id="basic-addon1">Inventory</span>
						<select name ="inventoryUnit_sa" id ="inventoryUnit_sa" class="form-control selectpicker" aria-describedby="basic-addon1" data-live-search="true">
						<option value="">None - Please Select</option>
						<?php echo $option_sponsorAds; ?>
						</select>
					</div>
					
				</div>	
			</div>
		
		<script>	
			$("#inventoryUnit_ba").change(function(){
					document.getElementById("inventoryName").value = $("#inventoryUnit_ba :selected").text();
			});
			$("#inventoryUnit_sa").change(function(){
					document.getElementById("inventoryName").value = $("#inventoryUnit_sa :selected").text();
			});
							
			$("#inventoryUnit input[name='type']").click(function(){
				
				if($('input:radio[name=type]:checked').val() == "Banner Ads"){
					$('#BA').show();
					$('#SA').hide();
					document.getElementById('inventoryType').value = 'bannerAds';
                	document.getElementById('inventoryUnit_sa').value = '';
					document.getElementById("inventoryName").value = $("#inventoryUnit_ba :selected").text();
				}else{
					$('#SA').show();
					$('#BA').hide();
					document.getElementById('inventoryType').value = 'sponsorAds';
                	document.getElementById('inventoryUnit_ba').value = '';
					document.getElementById("inventoryName").value = $("#inventoryUnit_sa :selected").text();
				}
			});		
			
		</script>
		
		<script >
			$(document).ready(function(){
				var type = document.getElementById('inventoryType').value;
				if(type == 'bannerAds'){
                    $('#BA').show();
					$('#SA').hide();
					document.getElementById('inventoryUnit_ba').value = "<?php echo $unitName; ?>";
					document.getElementById('bannerAds').checked = true;
										
				}else{
                    $('#SA').show();
					$('#BA').hide();
					document.getElementById('inventoryUnit_sa').value = "<?php echo $unitName; ?>";
					document.getElementById('sponsorAds').checked = true; 
		
				}
			});
			                                                                         
 		</script>	
		
		<h3>Website</h3>
		        	<div class="row">
						<div class="col-md-12">
							<div class="input-group">
								<span class="input-group-addon" id="basic-addon1">Website</span>
								<select name="website" id="website" required class="form-control"  aria-describedby="basic-addon1" >
									<option value = "TRO" selected>TRO</option>
									<option value = "TRAVELHOPPERS">TRAVELHOPPERS</option>
								</select>							
							</div>

						</div>
					</div>
		<script>
                document.getElementById('website').value = "<?php echo $website; ?>";
        </script>

		<h3>AD Size*</h3>
			<div class="row">
				<div class="col-md-12">
					<div class="input-group">
						<span class="input-group-addon" id="basic-addon1">AD Size</span>
						<input type="text" name="size" id="size" class="form-control"  aria-describedby="basic-addon1" value="<?php echo $size; ?>">
					</div>
				</div>
			</div>

		<h3>AD ID*</h3>
			<div class="row">
				<div class="col-md-12">
					<div class="input-group">
						<span class="input-group-addon" id="basic-addon1">AD ID</span>
						<input type="text" name="AdId" id="AdId" class="form-control"  aria-describedby="basic-addon1" value="<?php echo $AdId; ?>">
					</div>
				</div>
			</div>
		
		<h3>Campaign Dates*</h3>
            <div class="row">
				<div class="col-md-4">
						<div class="input-group">
							<span class="input-group-addon" id="basic-addon1">Week</span>
							<input type="text" name="week" id="week" class="form-control"  aria-describedby="basic-addon1" value="">
						</div>
				</div>
			</div>  
            <br>                                                                                                                
			<div class="row" id="sandbox-container">
				<div class="col-md-6">
					<div class="input-group">
						<span class="input-group-addon" id="basic-addon1">From</span>
						<input type="text" name="startDate" id="startDate" class="form-control"  aria-describedby="basic-addon1" value="<?echo $startDate;?>">
					</div>
				</div>
				<div class="col-md-6">
					<div class="input-group">
						<span class="input-group-addon" id="basic-addon1">To</span>
						<input type="text" name="endDate" id="endDate" class="form-control"  aria-describedby="basic-addon1" value="<?echo $endDate;?>">
					</div>
				</div>
			</div>
             <br>
         <div id="calendar"></div> 
		
                                                                                                                            
		<script>
        	
			$('.selectpicker').change(function(){
            	$('#calendar').fullCalendar('removeEvents',1);
				var inventoryName  = $("#inventoryName").val();		
				var data = 'inventoryName='+ inventoryName + '&inventoryType=' + $("#inventoryType").val();
				//alert(data);
				if(inventoryName){              
					$.ajax({
						type: "GET",
                    	url: '<? echo AJAX_URL; ?>/<?echo $getDate;?>',
						data: data,	
                    	dataType: 'json',
						success: function(events){
                              //console.log(events);
							  //var source = { events};
                        	//console.log(source);
							  //$('#calendar').fullCalendar('addEventSource', source);
                              //$('#calendar').fullCalendar('rerenderEvents');
							  
							colors = [
									  '#AACC00','#BBCC33','#CCCC66','#DDCC99','#EECCCC','#FFCCFF',
									  '#00FF00','#33AA30','#66BB60','#05CC79','#0cDD8C','#60EEAF',
									  '#0099AA','#0099BB','#0099CC','#0099DD','#0099EE','#0099FF'];									  
														
							for(i=0;i<events.length;i++){
								events[i].editable = false;
								events[i].end = events[i].end + "T23:59:00";
								events[i].color = colors[i%colors.length];
								$('#calendar').fullCalendar('renderEvent',events[i],true);
							}
							 					
							/* 
							$('#calendar').fullCalendar({
								eventSources:[
									{
										events:events,
										color: 'black',
										textColor: 'yellow'
									}
								]
							});
                            */
							
						}
					});
                    
				}				
				
			});
			
                                                       
			$('#sandbox-container input').datepicker({
				multidate: false,
                minDate: 0,                                                                                                            
				calendarWeeks: true,
				autoclose: true,
				todayHighlight: true
			});
			
            $('#startDate').change(function () {
		
            	$('#calendar').fullCalendar('removeEvents',0);
				var mon = $(this).datepicker('getDate');
				//mon.setDate(mon.getDate() + 1 - (mon.getDay() || 7));
				var sun = new Date(mon.getTime());
				var week = $('#week').val();
				sun.setDate(sun.getDate() + week * 7-1);
				var $endDate = $('#endDate');
				$endDate.datepicker('setDate', sun);
				//alert(mon + ' ' + sun);
				/*
				var res = document.getElementById('startDate').value;
				res = res.split("/");
				var start = res[2] +"-" + res[0] + "-" + res[1];
			
				var res = document.getElementById('endDate').value;
				res = res.split("/");
				var end = res[2] +"-" + res[0] + "-" + res[1];
				
				var newEvent = new Object();
				newEvent.title = document.getElementById('campaignName').value;
				newEvent.start = start;
				newEvent.end = end;
            	newEvent.id = 0;
            	newEvent.color = 'red';
            	newEvent.editable = false;
				
            	var name = $("#inventoryName").val();
            	if(name == 'Site Sponsor' || name == 'Anchor Banner Ad'){
                	if(!isOverlapping(newEvent)){
                    	alert("Overlap is not allowed!");
                    }else{
                    	$('#calendar').fullCalendar('renderEvent',newEvent,true);
                    }                	
                }else{
                	$('#calendar').fullCalendar('renderEvent',newEvent,true);
                }							
				*/
			});
			
			 $('#endDate').change(function () {
			 	
				$('#calendar').fullCalendar('removeEvents',0);
				
				var res = document.getElementById('startDate').value;
				res = res.split("/");
				var start = res[2] +"-" + res[0] + "-" + res[1];
				
				var res = document.getElementById('endDate').value;
				res = res.split("/");
				var end = res[2] +"-" + res[0] + "-" + res[1] + "T23:59:00";
			
				var newEvent = new Object();
				newEvent.title = document.getElementById('campaignName').value;
				newEvent.start = start;
				newEvent.end = end;
            	newEvent.id = 0;
            	newEvent.color = 'red';
            	newEvent.editable = false;
					
				
				var name = $("#inventoryName").val();
				var type = $('#inventoryType').val();
				if(name == 'Site Sponsor' || name == 'Anchor Banner Ad' || type == 'sponsorAds'){
					$('#calendar').fullCalendar('renderEvent',newEvent,true);
					if(isOverlapping(newEvent)){
						alert("Overlap is not allowed!");
						$('#calendar').fullCalendar('removeEvents',0);
						//clear the datepicker
					}            	
				}else{
					$('#calendar').fullCalendar('renderEvent',newEvent,true);
				}		
				
				
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
               
		
		
		
			<br>
        <div>
            <input type="hidden" name="ID"  value="<?php echo $ID; ?>" />                                                                                   
            <input  class="btn btn-lg btn-primary center-block" id="submit-button" type="submit" value="submit" />
        </div>
	</form>
	</div>  <!-- end of container-->
