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
					url: '".AJAX_URL."/salesTeam_do_search.php',	              
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
				var data = 'firstname='+vTr.find('.firstname').text() + '&cellphone='+vTr.find('.cellphone').text();	
				vTr.remove();

				$.ajax({
					type: 'GET',
					url: '".AJAX_URL."/salesTeam-delete.php',
					data: data,
					success: function(e){ // this happens after we get results
						//alert(e);
					}
	            });
			}
		}
		function add(){
			 window.location.href='".BASE_URL."salesTeam-add.php';
		}         
\n";

$addJavaScript[] = templateAddJavaScript($addJS);

$pageTitle = "SalesTeam-List";
include('templates/header.php');
?>

<div class="container">

<nav class="navbar navbar-default ">
  <!--This part is complated in header.php-->
</nav>

<div  id="results">
</div>

<div class="list-group animated bounceInDown"  id="allresult">

	<?php
	$db->query("select * from salesTeam order by ID");
	$db->execute();
	$row = $db->resultset();
	

	echo "<div class='panel panel-default'>";
	echo "<div class='panel-heading'>Sales Team Member</div>";
	echo "<table class='table' id='salesTeamList'>";
	echo "<thead><th>#</th><th>FirstName</th><th>LastName</th><th>Email</th><th>CellPhone</th><th>Action</th></thead>";
	$i = 1;
	$j = 0;
	echo "<tbody>";
	while($j<count($row)){

		echo "<tr>";
			echo "<th scope='row'>$i</th>";

			echo "<td class='firstname'>";
			echo "{$row[$j]['FirstName']}";
			echo "</td>";

			echo "<td>";
			echo "{$row[$j]['LastName']}";
			echo "</td>";

			echo "<td>";
			echo "{$row[$j]['Email']}";
			echo "</td>";

			echo "<td class='cellphone'>";
			echo "{$row[$j]['CellPhone']}";
			echo "</td>";

			$n = urlencode($row[$j]['FirstName']);
			echo "<td>";
    		echo "<a href='salesTeam-edit.php?firstname={$n}&cellphone={$row[$j]['CellPhone']}'>";
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