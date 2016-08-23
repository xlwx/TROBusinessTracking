<?
define('TRO_ADS',true);
include('init.php');
$db = new pdo_Database(DB_HOST, DB_NAME, DB_USER, DB_PASS);
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
					url: '".AJAX_URL."/emailBroadcast_do_search.php',	              
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
				var data = 'campaignName='+vTr.find('.campaignName').text();
				vTr.remove();

				$.ajax({
					type: 'GET',
					url: '".AJAX_URL."/emailBroadcast-delete.php',
					data: data,
					success: function(e){ // this happens after we get results
						//alert(e);
					}
	            });
			}
		}
		function add(){
			 window.location.href='".BASE_URL."emailBroadcast-add.php';
		}         
\n";

$addJavaScript[] = templateAddJavaScript($addJS);

$pageTitle = "Email Broadcast-List";
include('templates/header.php');
?>


<div class="container">

<nav class="navbar navbar-default">
  <!--This part is complated in header.php-->
</nav>

<div  id="results">
</div>

<div class="list-group animated bounceInDown"  id="allresult">

	<?php
	$db->query("select * from emailBroadcast order by ID");
	$db->execute();
	$row = $db->resultset();
	

	echo "<div class='panel panel-default'>";
	echo "<div class='panel-heading'>Email Broadcast</div>";
	echo "<table class='table' id='broadcast'>";
	echo "<thead><th>#</th><th>Campaign Name</th><th>Supplier Name</th><th>Broadcast Date</th><th>Broadcast Type</th><th>Server Account</th></thead>";
	$i = 1;
	$j = 0;
	echo "<tbody>";
	while($j<count($row)){

		echo "<tr>";
			echo "<th scope='row'>$i</th>";

			echo "<td class='campaignName'>";
			echo "{$row[$j]['CampaignName']}";
			echo "</td>";
			
    
    		$supplierIDs = $row[$j]['CampaignSupplier'];
			$suppliers = explode(',',$supplierIDs);

			$supplierName = array();
			foreach ($suppliers as $supplier){
				$sql_name = "select * from supplier where SupplierID = :supplier";
				$db->query($sql_name);
				$db->bind(":supplier", $supplier, PDO::PARAM_STR);
				$db->execute();
				$row_name=$db->single();
				array_push($supplierName,$row_name['Name']);
			}

			$supplierName = implode(',',$supplierName); 
			echo "<td>";
			echo "$supplierName";
			echo "</td>";
			
			echo "<td>";
			echo "{$row[$j]['BroadcastDate']}";
			echo "</td>";
			
			echo "<td>";
			echo "{$row[$j]['BroadcastType']}";
			echo "</td>";
			
			echo "<td>";
			echo "{$row[$j]['ServerAccount']}";
			echo "</td>";
    		
    		$n = urlencode($row[$j]['CampaignName']);
			echo "<td>";
			echo "<a href='emailBroadcast-edit.php?campaignName={$n}'>";
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
	<button type="button" class="btn btn-success" onclick="add()" >add one </button>
</div>

</div> <!--end of container-->


<?
include('templates/footer.php');
?>