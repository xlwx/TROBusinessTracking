<?
//session_start();
//$username = $_SESSION['username'];
//$admin = $_SESSION['admin'];
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
					url: '".AJAX_URL."/supplier_do_search.php',	              
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
				var data = 'name='+vTr.find('.list-group-item').text();		
				vTr.remove();

				$.ajax({
					type: 'GET',
					url: '".AJAX_URL."/supplier-delete.php',
					data: data,
					success: function(e){ // this happens after we get results
						//alert(e);
					}
	            });
			}
		}
		function add(){
			 window.location.href='".BASE_URL."supplier-add.php';
		}         
\n";

$addJavaScript[] = templateAddJavaScript($addJS);

$pageTitle = "Supplier-List";
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
	
	//limit items shown on one page
	$length=20;
	$pagenum=@$_GET['page']?$_GET['page']:1;

	//total amount of data
	$db->query("select * from supplier");
	$db->execute();
	$arrtot=count($db->resultset());
	$pagetot=ceil($arrtot/$length);
	
	//page limitation
	if($pagenum>=$pagetot){
		$pagenum=$pagetot;
	}
	$offset=($pagenum-1)*$length;
	
	$db->query("SELECT * FROM supplier ORDER BY Name limit {$offset},{$length}");
	$db->execute();
	$row = $db->resultset();
	
	echo "<div class='panel panel-default'>";
	echo "<div class='panel-heading'>Supplier</div>";
	echo "<table class='table' id='sponsorAdsList'>";
	$i = 1;
	$j = 0;
	echo "<tbody>";
	for($j=0;$j<count($row);$j++){
		
		echo "<tr>";
			
			echo "<td>";
    		$n = urlencode($row[$j]['Name']);
			echo "<a href='supplier-edit.php?name={$n}' class='list-group-item'>";
			echo "{$row[$j]['Name']}";
			echo "</a>";
			echo "</td>";
			
			echo "<td>";
			echo "<input type='button' name='btnDel' value='del' id='btnDel$i' class='btn btn-danger' />";
			echo "</td>";
			echo "<script> ".
				 "$('#btnDel$i').bind('click',delRow);" .
				 "</script>";
			
			$i++;

		echo "</tr>";
	}
	
	echo "</tbody>";
	echo "</table>";
	echo "</div>";
	
	//get previous page and next page
	$prevpage=$pagenum-1;
	$nextpage=$pagenum+1;
	
	echo "<h4><a href='supplier-list.php?page={$prevpage}'>prev </a><a href='supplier-list.php?page={$nextpage}'> next</a></h4>";
	?>

</div>
<div class="row">
	<button type="button" class="btn btn-success" onclick="add()" >add one </button>
</div>
</div> <!--end of container-->

<script>
	if('<?echo $_SESSION['admin'];?>' === 'no'){
    	$('.btn').hide();
    	$('#search').show();
    	$('#clear').show();
    }
</script>

<?
include('templates/footer.php');
?>