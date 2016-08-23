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
					url: '".AJAX_URL."/booking_do_search.php',	              
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
					url: '".AJAX_URL."/booking-delete.php',
					data: data,
					success: function(e){ // this happens after we get results
						//alert(e);
					}
	            });
			}
		}
		function add(){
			 window.location.href='".BASE_URL."booking-add.php';
		}         
\n";

$addJavaScript[] = templateAddJavaScript($addJS);

$pageTitle = "Booking-List";
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
	$db->query("select * from booking order by ID");
	$db->execute();
	$row = $db->resultset();

	echo "<div class='panel panel-default'>";
	echo "<div class='panel-heading'>Booking Items</div>";
	echo "<table class='table' id='bookingList'>";
	echo "<thead><th>#</th><th>Campaign</th><th>Supplier</th><th>Type</th><th>Unit</th><th>From</th><th>To</th><th>Sales Member</th><th>Size</th><th>ID</th><th>Website</th></thead>";
	$i = 1;
	$j = 0;
	echo "<tbody>";
	while($j<count($row)){

		echo "<tr>";
			echo "<th scope='row'>$i</th>";

			echo "<td class='campaignName'>";
			echo "{$row[$j]['CampaignName']}";
			echo "</td>";
			
			//supplierName
    		$supplierID = $row[$j]['SupplierID'];
			$sql_supplier = "select Name from supplier where SupplierID = :supplierID";
			$db->query($sql_supplier);
			$db->bind(":supplierID", $supplierID, PDO::PARAM_STR);
			$db->execute();
			$row_supplier=$db->single();
    		$supplierName = $row_supplier['Name'];
			echo "<td>";
			echo "$supplierName";
			echo "</td>";
			
			echo "<td>";
			echo "{$row[$j]['InventoryType']}";
			echo "</td>";

			$unitID = $row[$j]['InventoryID'];
			if($row[$j]['InventoryType'] == 'bannerAds'){
				$sql_unit = "select Name from bannerAds where BannerID = :unitID";
			}else{
				$sql_unit = "select Name from articles where ID = :unitID";
			}
			$db->query($sql_unit);
			$db->bind(":unitID", $unitID, PDO::PARAM_STR);
			$db->execute();
			$row_unit=$db->single();
			$unitName = $row_unit['Name'];
			echo "<td>";
			echo "$unitName";
			echo "</td>";
			
			echo "<td>";
			echo "{$row[$j]['StartDate']}";
			echo "</td>";
			
			echo "<td>";
			echo "{$row[$j]['EndDate']}";
			echo "</td>";
    		
    		$salesMemberID = $row[$j]['SalesMemberID'];
			$sql_salesmember = "select * from salesTeam where ID = :salesMemberID";
    		$db->query($sql_salesmember);
			$db->bind(":salesMemberID", $salesMemberID, PDO::PARAM_STR);
			$db->execute();
			$row_salesmember=$db->single();
    		$salesMemberName = $row_salesmember['FirstName'];
			echo "<td>";
			echo "$salesMemberName";
			echo "</td>";
    
    		echo "<td>";
			echo "{$row[$j]['Size']}";
			echo "</td>";
    
    		echo "<td>";
			echo "{$row[$j]['AdId']}";
			echo "</td>";
    		
    		echo "<td>";
			echo "{$row[$j]['Website']}";
			echo "</td>";
    		
    		$n = urlencode($row[$j]['CampaignName']);
			echo "<td>";
			echo "<a href='booking-edit.php?campaignName={$n}'>";
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