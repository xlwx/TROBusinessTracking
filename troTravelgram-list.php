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
					url: '".AJAX_URL."/troTravelgram_do_search.php',	              
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
					url: '".AJAX_URL."/troTravelgram-delete.php',
					data: data,
					success: function(e){ // this happens after we get results
						//alert(e);
					}
	            });
			}
		}
		function add(){
			 window.location.href='".BASE_URL."troTravelgram-add.php';
		}         
\n";

$addJavaScript[] = templateAddJavaScript($addJS);

$pageTitle = "TRO Travelgram-List";
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
	$db->query("select * from Travelgram order by BannerID");
	$db->execute();
	$row = $db->resultset();

	echo "<div class='panel panel-default'>";
	echo "<div class='panel-heading'>TRO Travelgram</div>";
	echo "<table class='table' id='salesTeamList'>";
	echo "<thead><th>#</th><th>Campaign</th><th>Supplier</th><th>Banner Type</th><th>Start</th><th>End</th></thead>";
	$i = 1;
	$j = 0;
	echo "<tbody>";
	while($j<count($row)){

		echo "<tr>";
			echo "<th scope='row'>$i</th>";

			echo "<td class='nameDel'>";
			echo "{$row[$j]['Name']}";
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
			echo "{$row[$j]['BannerType']}";
			echo "</td>";

			echo "<td >";
			echo "{$row[$j]['StartDate']}";
			echo "</td>";
			
			echo "<td >";
			echo "{$row[$j]['EndDate']}";
			echo "</td>";

			$n = urlencode($row[$j]['Name']);
			echo "<td>";
    		echo "<a href='troTravelgram-edit.php?campaignName={$n}'>";
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