<script>
		function add() {
			var table = document.getElementById("contactPersion");
			var rowCount = table.rows.length;
			var row = table.insertRow(rowCount);
			document.getElementById('rc').value = rowCount;

			var Name = row.insertCell(0);
			Name.innerHTML = "<input " + "name=" + "cpname"+ rowCount + " class='cpname form-control'" + " />";
			
			var Phone = row.insertCell(1);
			Phone.innerHTML = "<input " + "name=" + "cpphone"+ rowCount + " class='cpphone form-control'" + " />";

			var Email = row.insertCell(2);
			Email.innerHTML = "<input " + "name=" + "cpemail"+ rowCount + " class='cpemail form-control'" + " />";

			var Fax = row.insertCell(3);
			Fax.innerHTML = "<input " + "name=" + "cpfax"+ rowCount + " class='cpfax form-control'" + " />";

			var Del = row.insertCell(4);
			var id="btnDel"+rowCount;
			Del.innerHTML = "<input " + "type='button' "+ "name='btnDel' " + " value='del' " +"id="+ id + " class='btn btn-danger form-control'" + " />";

			$("#btnDel"+rowCount).bind("click",delRow);
		}

		function deleteLastPersion(){
			var table = document.getElementById("contactPersion");
			var rowCount = table.rows.length;
			document.getElementById('rc').value = rowCount;
			if(rowCount >1){
				table.deleteRow(rowCount-1);
			}
		}

		function delRow(){
			if (confirm('Are you sure that you want to delete it?')==true)
		   {
				var vbtnDel=$(this);
           
	        	var data = 'cpname='+ $(this).parent("td").parent("tr").find('input').val();
				//alert(data); 
           
	        	if(data) {
	            	$.ajax({
	                	type: "GET",
						url: '<?echo AJAX_URL;?>/contactPersion-delete.php',	              
	                	data: data,
	                	success: function(res){ // this happens after we get results
	                    	//alert(res);
	              		}
                                    
	            	});
	        	}
          	
				var vTr=vbtnDel.parent("td").parent("tr");
           		//console.log('nmb:'+$(this).parent("td").parent("tr").find('input').val());
				vTr.remove();
			}
		}
	</script>
                                                        
	
<?php
	/*
	$supplierID = '';
	$name = '';
	$street = '';
	$city = '';
	$zip = '';
	$state = '';
	$country = '';
	$phone = '';
	$fax = '';
	$email = '';
	$website = '';
	$facebook = '';
	$twitter = '';
	$linkedin = '';
	$youtube = '';
	$pinterest = '';
	$action = $update;
	include('templates/supplier_template.php');
	*/
?>

	<div class="container">
    <br>
    <div class="page-header">
	    <h1><?echo $pageTitle;?></h1>
    </div>
	<!--<script src="validation-edit.js"></script>-->
	<form id="formID" method="post" action="<? echo $action; ?>">

		<h3>Name*</h3>
			<div class="row">
				<div class="col-md-12">
					<div class="input-group">
						<span class="input-group-addon" id="basic-addon1">Name</span>
						<input type="text" name="name" id="name" class="form-control"  aria-describedby="basic-addon1" value="<?php echo $name; ?>">
                    	<input type="hidden"  id="originalName" value="<?php echo $name; ?>">
					</div>
				</div>
			</div>
		<h3>Address*</h3>
        <div class="row">
			<div class="col-md-12">
				<div class="input-group">
					<span class="input-group-addon" id="basic-addon1">Street</span>
					<input type="text" name="street" class="form-control" aria-describedby="basic-addon1" value="<?php echo $street; ?>">
				</div>
			</div>
      	</div>

      	<div class="row">
			<div class="col-md-8">
				<div class="input-group">
					<span class="input-group-addon" id="basic-addon1">City</span>
					<input type="text" name="city" class="form-control" aria-describedby="basic-addon1" value="<?php echo $city; ?>">
				</div>
			</div>
			<div class="col-md-4">
				<div class="input-group">
					<span class="input-group-addon" id="basic-addon1">Zip</span>
					<input type="text" name="zip" class="form-control" aria-describedby="basic-addon1" value="<?php echo $zip; ?>">
				</div>
			</div>
      	</div>

      	<div class="row">
			<div class="col-md-6">
				<div class="input-group">
					<span class="input-group-addon" id="basic-addon1">Country</span>
                	<select id="country" name ="country" class="form-control" aria-describedby="basic-addon1" value="<?php echo $country; ?>"></select>
				</div>
			</div>
			<div class="col-md-6">
				<div class="input-group">
					<span class="input-group-addon" id="basic-addon1">State</span>
                	<select name ="state" id ="state" class="form-control" aria-describedby="basic-addon1" value="<?php echo $state; ?>"></select>           
				</div>
			</div>
      	</div>
		<script >
    		populateCountries("country", "state");
        	document.getElementById('country').value = "<?php echo $country; ?>";
        	populateStates("country","state");
        	document.getElementById('state').value = "<?php echo $state; ?>";
 		</script>
        <h3>Phone*</h3>
        	<div class="row">
				<div class="col-md-12">
					<div class="input-group">
						<span class="input-group-addon" id="basic-addon1">Phone</span>
						<input type="text" name="phone" class="form-control"  aria-describedby="basic-addon1" value="<?php echo $phone; ?>">
					</div>
				</div>
			</div>


		<h3>Fax</h3>
			<div class="row">
				<div class="col-md-12">
					<div class="input-group">
						<span class="input-group-addon" id="basic-addon1">Fax</span>
						<input type="text" name="fax" class="form-control"  aria-describedby="basic-addon1" value="<?php echo $fax; ?>">
					</div>
				</div>
			</div>


		<h3>Email*</h3>
			<div class="row">
				<div class="col-md-12">
					<div class="input-group">
						<span class="input-group-addon" id="basic-addon1">Email</span>
						<input type="text" name="email" placeholder="your-name@example.com" class="form-control"  aria-describedby="basic-addon1" value="<?php echo $email; ?>">
					</div>
				</div>
			</div>


		<h3>Website*</h3>
			<div class="row">
				<div class="col-md-12">
					<div class="input-group">
						<span class="input-group-addon" id="basic-addon1">website</span>
						<input type="text" name="website" class="form-control"  aria-describedby="basic-addon1" value="<?php echo $website; ?>">
					</div>
				</div>
			</div>



		<h3>Social Media</h3>
			<div class="row">
				<div class="col-md-12">
					<div class="input-group">
						<span class="input-group-addon" id="basic-addon1" >Facebook</span>
						<input type="text" name="facebook" class="form-control"  aria-describedby="basic-addon1" value="<?php echo $facebook; ?>">
					</div>
				</div>
      		</div>

			<div class="row">
				<div class="col-md-12">
					<div class="input-group">
						<span class="input-group-addon" id="basic-addon1" >Twitter</span>
						<input type="text" name="twitter" class="form-control"  aria-describedby="basic-addon1" value="<?php echo $twitter; ?>">
					</div>
				</div>
      		</div>

      		<div class="row">
				<div class="col-md-12">
					<div class="input-group">
						<span class="input-group-addon" id="basic-addon1" >LinkedIn</span>
						<input type="text" name="linkedin" class="form-control"  aria-describedby="basic-addon1" value="<?php echo $linkedin; ?>">
					</div>
				</div>
      		</div>

			<div class="row">
				<div class="col-md-12">
					<div class="input-group">
						<span class="input-group-addon" id="basic-addon1" >Youtube</span>
						<input type="text" name="youtube" class="form-control"  aria-describedby="basic-addon1" value="<?php echo $youtube; ?>">
					</div>
				</div>
      		</div>

			<div class="row">
				<div class="col-md-12">
					<div class="input-group">
						<span class="input-group-addon" id="basic-addon1" >Pinterest</span>
						<input type="text" name="pinterest" class="form-control"  aria-describedby="basic-addon1" value="<?php echo $pinterest; ?>">
					</div>
				</div>
      		</div>

		<div >

			<div class="panel panel-default row">
			  <!-- Default panel contents -->
			  <div class="panel-heading">Contact Persion</div>

			  <!-- Table -->
			  <table class="table" id="contactPersion">
					<tr>
						<td>name</td>
						<td>phone</td>
						<td>email</td>
						<td>fax</td>
						<td>action</td>
					</tr>

					<?php
						$i = 0;
						if($pageTitle == 'Supplier Edit'){
                        	$sql="select * from contactpersion where SupplierID = :supplierID";
							$db->query($sql);
							$db->bind(":supplierID", $supplierID, PDO::PARAM_STR);
							$db->execute();
							$row = $db->resultset();	

							$i = 1;
							$j = 0;
							while($j<count($row)) {
								$contactpersionID = $row[$j]['ContactPersionID'];
								$cpname = $row[$j]['Name'];
								$cpphone = $row[$j]['Phone'];
								$cpemail = $row[$j]['Email'];
								$cpfax = $row[$j]['Fax'];
								echo "<tr>";
								echo "<td><input name='cpname$i' class='cpname form-control' value='$cpname' /></td>";
								echo "<td><input name='cpphone$i' class='cpphone form-control' value='$cpphone' /></td>";
								echo "<td><input name='cpemail$i' class='cpemail form-control' value='$cpemail' /></td>";
								echo "<td><input name='cpfax$i' class='cpfax form-control' value='$cpfax' /></td>";
								echo "<td><input type='button' name='btnDel' value='del' id='btnDel$i' class='btn btn-danger form-control' /></td>";
								echo "</tr>";
								echo "<input type='hidden' name='cpID$i'  value='$contactpersionID' />";
						
								echo "<script> ".
								 	"$('#btnDel$i').bind('click',delRow);" .
								 	"</script>";
								$i++;
								$j++;
							}
                        }	
					?>

			  </table>
			</div>
	  		<div class="row">
			    <button type="button" class="btn btn-success"  onclick="add()">add one </button>
			    <button type="button" class="btn btn-danger"  onclick="deleteLastPersion()">del last </button>
				<input type="hidden" name="rowCount" id="rc" value="<?php echo $i; ?>" />
				<input type="hidden" name="supplierID"  value="<?php echo $supplierID; ?>" />
        	</div>
        </div>

		<br>
        <div>
            <input  class="btn btn-lg btn-primary center-block" id="submit-button" type="submit" value="submit" />
        </div>
	</form>
	</div>  <!-- end of container-->
	