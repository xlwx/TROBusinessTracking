<?
define('TRO_ADS',true);
include('init.php');
$db = new pdo_Database(DB_HOST, DB_NAME, DB_USER, DB_PASS);
$insert = INCLUDES_URL.'/bannerAds-insert.php';
$addScript[] = templateAddScript(JS_URL."/bannerAds-edit-validation.js");
$addJS = "
	$(function() {
		
        $(\"#clear\").click(function() {
        	
		});                          
                                  
	    $(\"#search\").click(function() {
	        // getting the value that user typed
	        var searchString  = $(\"#search-input\").val();
	        // forming the queryString
	        var data = 'search='+ searchString;
			//alert(data);
	        // if searchString is not empty
	        if(searchString) {
	            // ajax call
	            $.ajax({
	                type: \"GET\",
					url: '".AJAX_URL."/bannerAds_do_search.php',	              
	                data: data,
	                success: function(html){ // this happens after we get results
	                    $(\"#results\").show();
	                    $(\"#results\").html(html);
                        $(\"#allresult\").hide();
	              }
                                    
	            });
	        }else{
                   $(\"#allresult\").show();   
                   $(\"#results\").hide();
            }
	        return false;
	    });
	});	
             
    function delRow(){
			if (confirm('Are you sure that you want to delete it?')==true)
		   {
				
                var vbtnDel=$(this);
                var vTr=vbtnDel.parent('td').parent('tr');                          
				var data = 'name='+vTr.find('.nameDel').text();	
				vTr.remove();

				$.ajax({
					type: 'GET',
					url: '".AJAX_URL."/bannerAds-delete.php',
					data: data,
					success: function(e){ // this happens after we get results
						//alert(e);
					}
	            });
			}
		}
		function add(){
			 //window.location.href='".BASE_URL."bannerAds-add.php';
		}         
\n";

$addJavaScript[] = templateAddJavaScript($addJS);

$pageTitle = "bannerAds-List";
include('templates/header.php');
?>

<div class="container">

<nav class="navbar navbar-default">
 <!--This part is complated in header.php-->
</nav>

<div  id="results">
</div>

<div class="list-group animated bounceInDown"  id="allresult">

	<?
	
	$db->query("select * from bannerAds order by BannerID");
	$db->execute();
	$row = $db->resultset();
	

	echo "<div class='panel panel-default'>";
	echo "<div class='panel-heading'>Banner Ads</div>";
	echo "<table class='table' id='salesTeamList'>";
	echo "<thead><th>#</th><th>Name</th><th>Value($)</th><th>Run Period(week)</th><th>Available Units</th></thead>";
	$i = 1;
	$j = 0;
	echo "<tbody>";
	while($j<count($row)){

		echo "<tr>";
			echo "<th scope='row'>$i</th>";

			echo "<td class='nameDel'>";
			echo "{$row[$j]['Name']}";
			echo "</td>";

			echo "<td align='left'>";
			echo "{$row[$j]['Value']}";
			echo "</td>";

			echo "<td align='left'>";
			echo "{$row[$j]['RunPeriod']}";
			echo "</td>";

			echo "<td align='left'>";
			echo "{$row[$j]['AvailableUnits']}";
			echo "</td>";

			$n = urlencode($row[$j]['Name']);
			echo "<td>";
    		echo "<a href='bannerAds-edit.php?name={$n}'>";
			echo "<input type='button' name='btnEdit' value='edit' id='btnEdit$i' class='btn btn-primary' />";
			echo "</a>";
			echo "&nbsp&nbsp&nbsp<input type='button' name='btnDel' value='del' id='btnDel$i' class='btn btn-danger' />";
			echo "</td>";
			echo "<script> ".
				 "$('#btnDel$i').bind('click',delRow);" .
				 "</script>";
			$i++;
			$j++;

		echo "</tr>";
	}
	echo "</tbody>";
	echo "</table>";
	echo "</div>";

?>

</div>

<div class="row">
	<button type="button" class="btn btn-success" data-toggle="modal" data-target="#myModal" >add one </button>
</div>

</div> <!--end of container-->

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">New banner ads</h4>
      </div>
      <div class="modal-body">
        <!-- --------------------------------------------------------------------------------------- -->
      	<div class="container">
   			<div >
	        	<h3>Add bannerAds</h3>
    		</div>
	
		<form id="bannerAds" method="post" action="<? echo $insert; ?>">

		<h3>Name</h3>
			<div class="row">
				<div class="col-md-6">
					<div class="input-group">
						<span class="input-group-addon" id="basic-addon1">Name</span>
						<input type="text" name="name" id="name"  class="form-control"  aria-describedby="basic-addon1">
					</div>
				</div>
			</div>

		<h3>Value</h3>
			<div class="row">
				<div class="col-md-6">
					<div class="input-group">
						<span class="input-group-addon">$</span>
						<input type="text" name="value" id="value" class="form-control"  aria-describedby="basic-addon1" >
						<span class="input-group-addon">.00</span>
					</div>
				</div>
			</div>

		<h3>Run Period</h3>
		        	<div class="row">
						<div class="col-md-6">
							<div class="input-group">
								<span class="input-group-addon" id="basic-addon1">Run Period</span>
								<select name="runPeriod" id="runPeriod" required class="form-control"  aria-describedby="basic-addon1">
									<option value="">None</option>
									<option value = "1">1</option>
									<option value = "15">15</option>
									<option value = "20">20</option>
									<option id="other" value = "other">other</option>
								</select>
								<span class="input-group-addon" id="basic-addon1">weeks</span>
							</div>

							<div type="hide" id="custom" class="input-group">
								<span class="input-group-addon">Input the run period required</span>
								<input type="text" name="customPeriod" id="customPeriod" class="form-control"  aria-describedby="basic-addon1" onchange="change()">
								<span class="input-group-addon">weeks</span>
							</div>

						</div>
					</div>
		<script>
			$("#custom").hide();
			$('#runPeriod').change(function(){
				if($(this).val() == 'other'){
					$("#custom").show();
				}else{
					$("#custom").hide();
				}
			});
                               
			function change() {
			    var customPeriod = document.getElementById("customPeriod");
                var other = document.getElementById("other");
			    other.value = customPeriod.value;
                //alert(other.value);
			}		
                                                     
		</script>

		<h3>Available Units</h3>
				    <div class="row">
						<div class="col-md-6">
							<div class="input-group">
								<span class="input-group-addon" id="basic-addon1">Available Units</span>
								<input type="text" name="availableUnits" class="form-control"  aria-describedby="basic-addon1" >
							</div>
						</div>
					</div>


	</form>
	</div>  <!-- end of container-->
      
      	<!-- --------------------------------------------------------------------------------------- -->
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button id="myFormSubmit" type="submit" class="btn btn-primary">Submit</button>
      	<script>
      		$(function(){
    			$('#myFormSubmit').click(function(e){
                if($('#name').val() != "" && $('#value').val() != "" && $('#runPeriod').val() != "" && $('#availableUnits').val() != ""){
                	e.preventDefault();
                	$.post(<? echo "'".$insert."'"; ?>, 
               		$('#bannerAds').serialize(), 
         	   			function(data, status, xhr){
        				//$("#myModal").modal('hide');
        				location.reload();
         	   		});
                }else{
                	alert("Invalid form! Please recheck the input!");
                }
     
      			
    		});
		});
        </script>
      </div>
    </div>
  </div>
</div>

<script>
	if('<?echo  $_SESSION['admin'];?>' === 'no'){
    	$('.btn').hide();  
    	$('#search').show();
    	$('#clear').show();
    }
</script>

<?
include('templates/footer.php');
?>