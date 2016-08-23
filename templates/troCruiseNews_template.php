<?
	/*
	$name = $_GET['name'];
	$bannerID = '';
	$bannerType = '';
	$startDate = '';
	$endDate = '';
	$bannerCode = '';
	$supplierName = '';
	$action = $update;
	
	$edit = 'troCruiseNews-edit.php';
	$getBookingInfo = 'troCruiseNews-getBookingInfo.php';
	$getDate = 'troCruiseNews-getDate.php';
	

	include('templates/troCruiseNews_template.php');
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
								$('#supp').val(Info[0]);
								$('#type').val(Info[1]);
								$('#start').val(Info[2]);
								$('#end').val(Info[3]);
								
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
					<h4>Supplier</h4>   
					<div class="row">
						<div class="col-md-12">
							&nbsp&nbsp&nbsp<input name="supp" id="supp" value="" readonly style="border:none">							
						</div>	
					</div>
					
					<h4>Banner Type</h4>   
					<div class="row">
						<div class="col-md-12">							
							&nbsp&nbsp&nbsp<input name="type" id="type" value="" readonly style="border:none">							
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

	<div class="container">
    <br>
    <div class="page-header">
	    <h1><?echo $pageTitle;?></h1>
    </div>
	<form id="troCruiseNews" method="post" action="<? echo $action; ?>">
		<?php
			
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
		
		<h3>Name</h3>
			<div class="row">
				<div class="col-md-12">
					<div class="input-group">
						<span class="input-group-addon" id="basic-addon1">Name</span>
						<input type="text" name="name" id="name"  class="form-control"  aria-describedby="basic-addon1" value="<?php echo $name; ?>">
					</div>
				</div>
			</div>

		<h3>Supplier Name*</h3>   
			<div class="row">
				<div class="col-md-12">
					<div class="input-group">
						<span class="input-group-addon" id="basic-addon1">Supplier</span>
						<select id="supplierName" name ="supplierName" class="form-control selectpicker" aria-describedby="basic-addon1" data-live-search="true">
						<option value="">None - Please Select</option>
						
						<?php echo $option_supplier; ?>
						
						</select>
					</div>
				</div>	
			</div>
		<script>
                document.getElementById('supplierName').value = "<?php echo $supplierName; ?>";
        </script>

		<h3>Banner Type</h3>
		        	<div class="row">
						<div class="col-md-12">
							<div class="input-group">
								<span class="input-group-addon" id="basic-addon1">Banner Type</span>
								<select name="bannerType" id="bannerType" required class="form-control"  aria-describedby="basic-addon1" >
									<option value="">Please Select</option>
									<option value = "sponsor">Sponsor</option>
									<option value = "callout">Call Out</option>
								</select>							
							</div>

						</div>
					</div>
		<script>
                document.getElementById('bannerType').value = "<?php echo $bannerType; ?>";
        </script>
    
    	<h3>AD ID*</h3>
			<div class="row">
				<div class="col-md-12">
					<div class="input-group">
						<span class="input-group-addon" id="basic-addon1">AD ID</span>
						<input type="text" name="AdId" id="AdId" class="form-control"  aria-describedby="basic-addon1" value="<?php echo $AdId; ?>">
					</div>
				</div>
			</div>
    	
		<h3>Description</h3>
		        	<div class="row">
						<div class="col-md-12">
							<div type="hide" id="sp">
								<p>1 per issue, 1 issue per week on Friday</p>
							</div>
							
							<div type="hide" id="ca">
								<p>6-9 per issue, 1 issue per week on Friday</p>
							</div>
                        
                        	<div type="hide" id="lb">
								<p>only 1 per issue</p>
							</div>
							
							<div type="hide" id="description">
								<p>Please select the banner type</p>
							</div>
						</div>
					</div>
		<script>         
			$("#sp").hide();    
            $("#ca").hide(); 
        	$("#lb").hide();
		</script>
		
		<h3>Dates*</h3>
            <div class="row">
				<div class="col-md-4">
						<div class="input-group">
							<span class="input-group-addon" id="basic-addon1">Week</span>
							<input type="text" name="week" id="week" class="form-control"  aria-describedby="basic-addon1" value="1">
						</div>
				</div>
			</div>  
            <br>                                                                                                                
			<div class="row" id="sandbox-container">
				<div class="col-md-6">
					<div class="input-group">
						<span class="input-group-addon" id="basic-addon1">From</span>
						<input type="text" name="startDate" id="startDate" class="form-control"  aria-describedby="basic-addon1"
							   value="<?php echo "$startDate"; ?>">
					</div>
				</div>
				<div class="col-md-6">
					<div class="input-group">
						<span class="input-group-addon" id="basic-addon1">To</span>
						<input type="text" name="endDate" id="endDate" class="form-control"  aria-describedby="basic-addon1"
							   value="<?php echo "$endDate"; ?>">
					</div>
				</div>
			</div>
		<br>	
		<div id="calendar"></div>
		<script>
        	
			$('#bannerType').change(function(){
            	if($(this).val() == 'sponsor'){
					$("#sp").show();
					$("#ca").hide();
                	$("#lb").hide();
					$("#description").hide();
				}else if($(this).val() == 'callout'){
					$("#sp").hide();
					$("#ca").show();
                	$("#lb").hide();
					$("#description").hide();
				}else if($(this).val() == 'leaderboard'){
                	$("#sp").hide();
					$("#ca").hide();
                	$("#lb").show();
					$("#description").hide();
                }else{
					$("#sp").hide();
					$("#ca").hide();
                	$("#lb").hide();
					$("#description").show();
				}
            	
            	$('#calendar').fullCalendar('removeEvents',1);
				var bannerType  = $("#bannerType").val();		
				var data = 'bannerType='+ bannerType;
				if(bannerType){              
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
								events[i].end = events[i].end + "T23:59:00";
								events[i].color = colors[i%colors.length];
								$('#calendar').fullCalendar('renderEvent',events[i],true);
							}
							
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
				newEvent.title = document.getElementById('name').value;
				newEvent.start = start;
				newEvent.end = end;
            	newEvent.id = 0;
            	newEvent.color = 'red';
            	newEvent.editable = false;
					
				
				var bannerType = $('#bannerType').val();
				if(bannerType == 'sponsor'){
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

		
		<h3>BannerCode</h3>
			<input type="checkbox" id="addition" onclick="showMe()"> I have it
				    <div class="row" id="bannercode_div" style="display:none">
						<div class="col-md-12">
							<div class="input-group">
								<span class="input-group-addon" id="basic-addon1">Addttion</span>
								<textarea type="text" rows="8" name="bannerCode" class="form-control"  aria-describedby="basic-addon1" 
											><?php echo $bannerCode; ?></textarea>
							</div>
						</div>
					</div>

		<script>
			function showMe () {      
				var div = document.getElementById("bannercode_div");
				if(document.getElementById("addition").checked){
					div.style.display = 'block';
     				
				}else{
					div.style.display = 'none';
				}			
			}
		</script>
		
		<br>
        <div>
            <input type="hidden" name="ID" value="<?php echo $bannerID; ?>">
            <input  class="btn btn-lg btn-primary center-block" id="submit-button" type="submit" value="submit" />
        </div>
	</form>
	</div>  <!-- end of container-->