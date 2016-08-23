<!DOCTYPE html>
<?
	define('TRO_ADS',true);
	include('init.php');
	$insert = INCLUDES_URL.'/user-insert.php';
?>
<html>
<head>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="chenqi_zhang">
   
    <title>Travel Research Online</title>
	
<!--jquery-->
<script src="http://code.jquery.com/jquery-2.2.3.min.js"></script>
<!---validation-->
<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.15.0/jquery.validate.min.js"></script>
<script src="<? echo JS_URL; ?>/jquery.easing.1.3.js"></script>
<script src="<? echo JS_URL; ?>/countries.js"></script>
<link href="<? echo CSS_URL; ?>/register.css" rel="stylesheet">
</head>
<body>
<!-- multistep form -->
<form id="msform" action="<? echo $insert; ?>" method="post">
	<!-- progressbar -->
	<ul id="progressbar">
		<li class="active">ACCOUNT SETUP</li>
		<li>PERSIONAL DETAILS</li>
		<li>SUCCESSFUL</li>
	</ul>
	<!-- fieldsets -->
	<fieldset>
		<h2 class="fs-title">Create your account</h2>
		<h3 class="fs-subtitle">Please avoid using easy password</h3>
		<input type="text" id="username" name="username" placeholder="username" />
		<input type="password" id="pass" name="pass" placeholder="Password" />
		<input type="password" name="cpass" placeholder="Confirm Password" />
		<input type="button"  name="next" class="next action-button" value="Next" />
	</fieldset>
	<fieldset>
		<h2 class="fs-title">Personal Details</h2>
		<h3 class="fs-subtitle">Step 2</h3>
	
		<input type="text" name="firstname" id="fisrtname" placeholder="FirstName">
		<input type="text" name="lastname" id="lastname" placeholder="LastName">
		
		<input type="text" name="email" placeholder="Email">
		<input type="text" name="cellphone" placeholder="Cellphone">
		<input type="text" name="homephone" placeholder="Homephone">
		<input type="text" name="fax" placeholder="Fax">
		
		<input type="text" name="street" placeholder="Street">
		<input type="text" name="city" placeholder="City">
		<input type="text" name="zip" placeholder="Zip">
		
		<select id="country" name ="country" placeholder="Country">	</select>
		<select name ="state" id ="state" placeholder="State"></select>
		
		
		<input type="button" name="previous" class="previous action-button" value="Previous" />
		<input type="button" name="next" class="next action-button" value="Next" />
		
		<script >
    		populateCountries("country", "state");	
        	populateStates("country","state");  
 		</script>
    	<input type="hidden" name="commissionRate" value="0">
	</fieldset>
	<fieldset>
		<h2 class="fs-title">Successful</h2>
		<h3 class="fs-subtitle">congratulations</h3>
		<p>You can still change the information before submit</p>
		<input type="button" name="previous" class="previous action-button" value="Previous" />
		<input type="submit" name="submit" class="submit action-button" value="Submit" />
	</fieldset>
</form>
<script>
$(document).ready(function() {
  $(window).keydown(function(event){
    if(event.keyCode == 13) {
      event.preventDefault();
      return false;
    }
  });
});
</script>
<script src="<? echo JS_URL; ?>/register.js"></script>
</body>
</html>
