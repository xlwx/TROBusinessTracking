<?
define('TRO_ADS',true);
include('init.php');
$addStyleSheet[] = templateAddStyleSheet("//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.10.0/css/bootstrap-select.min.css");
$addStyleSheet[] = templateAddStyleSheet(CSS_URL."/bootstrap-datepicker.min.css");
$addScript[] = templateAddScript("//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.10.0/js/bootstrap-select.min.js");
$addScript[] = templateAddScript(JS_URL."/bootstrap-datepicker.min.js");
$addScript[] = templateAddScript(JS_URL."/moment.min.js");

$ajaxURL = AJAX_URL .'/emailBroadcastAdvSearch.php';
$pageTitle = 'Email Broadcast Advanced Search';
include('templates/header.php');
?>
<script>
	$('#searchForm').hide();
</script>
<br>
<br>
<div class='container'>
	<h2>Advanced Search</h2>
	<h3><?echo $pageTitle;?></h3>

	
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
  <br>
  <div class="row placeholders">
		<div class="col-md-4">
			<div class="input-group">
				<span class="input-group-addon" id="basic-addon1">Broadcast Type</span>
					<select id="type" name ="type" data-live-search="true" class="form-control selectpicker" 
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
  <br>
  <div class="row placeholders">
		<div class="col-md-4">
			<div class="input-group">
				<span class="input-group-addon" id="basic-addon1">Server Account</span>
					<select id="server" name ="server" class="form-control selectpicker" 
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
  <br>
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
			$('#sandbox-container input').datepicker({
				multidate: false,
				minDate: 0,                                                                                                            
				calendarWeeks: true,
				autoclose: true,
				todayHighlight: true
			});
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
	<br>
	
	<button class="btn btn-default" id="se">Submit</button>
	<button class="btn btn-default" id="cl">clear</button>
	<br>
	<div  id="results">
	</div>

	<script>
		$("#cl").click(function() {
				alert('nmb');
		});                          
									  
		$("#se").click(function() {
			var data = 'supplierName='+ $('#supplierName').val() +'&broadcastType=' + $('#type').val()+'&serverAccount='+$('#server').val() +'&start='+$('#startDate').val()+'&end='+$('#endDate').val();
			//data = encodeURIComponent(data);
			if(data) {
				alert(data);
				// ajax call
				$.ajax({
					type: "GET",
					url: "<?echo $ajaxURL; ?>",	              
					data: data,
					success: function(html){ // this happens after we get results
						alert(html);
						$("#results").show();
						$("#results").html(html);
				  }
									
				});
			}
			return false;
			
		});
	</script>

	
</div>
<?include('templates/footer.php');?>
