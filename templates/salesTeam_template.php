<?php
	/*
	$ID = '';
	$firstname = '';
	$lastname = '';
	$email = '';
	$cellphone = '';
	$homephone = '';
	$fax = '';
	$street = '';
	$city = '';
	$zip = '';
	$state = '';
	$country = '';
	$commissionRate = '';
	*/
?>

	<div class="container">
    <br>
    <div class="page-header">
	        <h1><?echo $pageTitle;?></h1>
    </div>
	<!--<script src="validation.js"></script>-->
	<form id="salesPersion" method="post" action="<? echo $action; ?>">

		<h3>First Name*</h3>
			<div class="row">
				<div class="col-md-12">
					<div class="input-group">
						<span class="input-group-addon" id="basic-addon1">FirstName</span>
						<input type="text" name="firstname" id="fisrtname" class="form-control"  aria-describedby="basic-addon1" value="<?php echo $firstname; ?>">
					</div>
				</div>
			</div>

		<h3>Last Name*</h3>
			<div class="row">
				<div class="col-md-12">
					<div class="input-group">
						<span class="input-group-addon" id="basic-addon1">LastName</span>
						<input type="text" name="lastname" id="lastname" class="form-control"  aria-describedby="basic-addon1" value="<?php echo $lastname; ?>">
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

		<h3>Cell Phone*</h3>
			<div class="row">
				<div class="col-md-12">
					<div class="input-group">
						<span class="input-group-addon" id="basic-addon1">Cell Phone</span>
						<input type="text" name="cellphone" class="form-control"  aria-describedby="basic-addon1" value="<?php echo $cellphone; ?>">
					</div>
				</div>
			</div>

		<h3>Home Phone</h3>
			<div class="row">
				<div class="col-md-12">
					<div class="input-group">
						<span class="input-group-addon" id="basic-addon1">Home Phone</span>
						<input type="text" name="homephone" class="form-control"  aria-describedby="basic-addon1" value="<?php echo $homephone; ?>">
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

		<h3>Commission Rate*</h3>
			<div class="row">
				<div class="col-md-12">
					<div class="input-group">
						<span class="input-group-addon" id="basic-addon1">Commission Rate</span>
						<input type="text" id="commissionRate" name="commissionRate" class="form-control"  aria-describedby="basic-addon1" value="<?php echo $commissionRate; ?>">
					</div>
				</div>
			</div>


	  		<div class="row">
				<input type="hidden" name="ID"  value="<?php echo $ID; ?>" />
        	</div>
        

		<br>
        <div>
            <input  class="btn btn-lg btn-primary center-block" id="submit-button" type="submit" value="submit" />
        </div>
	</form>
	</div>  <!-- end of container-->
