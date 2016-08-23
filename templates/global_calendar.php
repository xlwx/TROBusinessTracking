<?
/*
	$edit = 'booking-edit.php';
	$getBookingInfo = 'booking-getBookingInfo.php';
	$getID = 'getBannerID.php';
	$getDate = 'calendar-bannerAds-getDate.php';
	$name = 'bannerName';
	$data = "'bannerID='+id;";
	$htmlItem = 'bannerAds';
	
	//for popover html elements
	$item_0 = 'supplier';
	$item_1 = 'salesMember';
	$item_2 = 'inventoryUnit';
	$item_3 = 'start';
	$item_4 = 'end';
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
				$('#eventUrl').attr('href','<? echo $edit; ?>?campaignName='+event.title);
				var campaignName  = event.title;		
				var data = 'campaignName='+ campaignName;
				//alert(data);
				if(campaignName){              
					$.ajax({
						type: 'GET',
						url: '<? echo AJAX_URL; ?>/<? echo $getBookingInfo; ?>',
						data: data,	
						//dataType: 'json',
						success: function(bookingInfo){
							//alert(bookingInfo);  
							var Info = bookingInfo.split('-');
							$('#<?echo $item_0;?>').val(Info[0]);
							$('#<?echo $item_1;?>').val(Info[1]);
							$('#<?echo $item_2;?>').val(Info[2]);
							$('#<?echo $item_3;?>').val(Info[3]);
							if(Info[4]){
								$('#<?echo $item_4;?>').val(Info[4]);
							}
                        	if(Info[5]){
                            	$('#<?echo $item_5;?>').val(Info[5]);
                            	$('#<?echo $item_6;?>').val(Info[6]);
                            }
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

	<script>
        	
		$('.form-control').change(function(){
			$('#calendar').fullCalendar('removeEvents',1);
			var <?echo $name;?>  = $("#<?echo $htmlItem;?>").val();	
			var data = '<?echo $name;?>='+ <?echo $name;?>;
        	$.ajax({
				type: "GET",
				url: '<? echo AJAX_URL; ?>/<? echo $getID; ?>',
				data: data,	
				dataType: 'text',
				success:function(id){
					getDate(id);
				}
			});
        function getDate(id){
        	
        	var data = <?echo $data;?>
        	if(id){              
				$.ajax({
					type: "GET",
					url: '<? echo AJAX_URL; ?>/<?echo $getDate; ?>',
					data: data,	
					dataType: 'json',
					success: function(events){
						//console.log(events);
						  
						colors = [
								  '#AACC00','#BBCC33','#CCCC66','#DDCC99','#EECCCC','#FFCCFF',
								  '#00FF00','#33AA30','#66BB60','#05CC79','#0cDD8C','#60EEAF',
								  '#0099AA','#0099BB','#0099CC','#0099DD','#0099EE','#0099FF'];									  
													
						for(i=0;i<events.length;i++){
							events[i].editable = false;
							events[i].end = events[i].end + "T23:59:00";
							events[i].color = colors[i%colors.length];
							//call isWithinRange()
							if(s<e){
                            	console.log('ns:'+s+' '+'ne:'+e);
                                console.log('s:'+events[i].start+' e:'+events[i].end)
                            	
								if(isWithinRange(s,e,events[i]) == null){                      	
                                	continue;
                                }else{
                                	events[i] = isWithinRange(s,e,events[i]);
                                }
							}
							$('#calendar').fullCalendar('renderEvent',events[i],true);
						}
											
						
					}
				});
				
			}		
        }		
			
		});
	
$('#sandbox-container input').datepicker({
				multidate: false,
                minDate: 0,                                                                                                            
				calendarWeeks: true,
				autoclose: true,
				todayHighlight: true
		});
			
    		var s = '';
			var e = '';				
    
            $('#startDate').change(function () {
		
				var res = document.getElementById('startDate').value;
				res = res.split("/");
				var start = res[2] +"-" + res[0] + "-" + res[1] +"T23:59:00";
				
				var res = document.getElementById('endDate').value;
				res = res.split("/");
				var end = res[2] +"-" + res[0] + "-" + res[1] + "T23:59:00";
					
				s = new Date(start);
				e = new Date(end);
				//console.log(s+' '+e);	

			});
    
			 $('#endDate').change(function () {
			 				
				var res = document.getElementById('startDate').value;
				res = res.split("/");
				var start = res[2] +"-" + res[0] + "-" + res[1] +"T23:59:00";
				
				var res = document.getElementById('endDate').value;
				res = res.split("/");
				var end = res[2] +"-" + res[0] + "-" + res[1] + "T23:59:00";
					
				s = new Date(start);
				e = new Date(end);
				//console.log(s+' '+e);	
			});
		
		//Check Date Range
        	function isWithinRange(ns,ne,event){   			
				var s = new Date(event.start);
				var e = new Date(event.end);
				if(e<ns || s>ne){
                	console.log('out of range');
					return null;
				}else if(ns>=s && ns<=e && e<=ne){
                	console.log('beyond left'); 
					event.start = ns;
				}else if(ne>=s && ne<=e && s>=ns){
                	console.log('beyond right');
					event.end = ne;
				}else if(s<=ns && e>=ne){
					event.start = ns;
					event.end = ne;
                	console.log('within range');
				}
            	return event;
			}
			
		
	</script>
	
	  <h2 class="page-header">Calendar</h2>
		<div id="calendar"></div>
	<script>
    	if('<?echo $_SESSION['admin'];?>' === 'no'){
    		$('#eventUrl').hide();    	
   		}
    </script>
