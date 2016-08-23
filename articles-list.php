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
					url: '".AJAX_URL."/articles_do_search.php',	              
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
					url: '".AJAX_URL."/articles-delete.php',
					data: data,
					success: function(e){ // this happens after we get results
						//alert(e);
					}
	            });
			}
		}
		function add(){
			 window.location.href='".BASE_URL."articles-add.php';
		}         
\n";

$addJavaScript[] = templateAddJavaScript($addJS);

$pageTitle = "Articles-List";
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
	$db->query("select * from articles order by ID");
	$db->execute();
	$row = $db->resultset();
	
	echo "<div class='panel panel-default'>";
	echo "<div class='panel-heading'>Sponsor Ads</div>";
	echo "<table class='table' id='sponsorAdsList'>";
	echo "<thead><th>#</th><th>Name</th><th>Number of Units</th><th>Value</th></thead>";
	$i = 1;
	$j = 0;
	echo "<tbody>";
	while($j<count($row)){

		echo "<tr>";
			echo "<th scope='row'>$i</th>";

			echo "<td class='nameDel'>";
			echo "{$row[$j]['Name']}";
			echo "</td>";

			echo "<td>";
			echo "{$row[$j]['NumberOfUnit']}";
			echo "</td>";

			echo "<td>";
			echo "{$row[$j]['Value']}";
			echo "</td>";
        		
			echo "<td class='edit'>";
    		echo "<a href='articles-edit.php?name={$row[$j]['Name']}'>";
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