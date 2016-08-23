<?
define('TRO_ADS',true);
include('init.php');
$update = INCLUDES_URL.'/account-update.php';
$addScript[] = templateAddScript(JS_URL."/account-update-validation.js");
$pageTitle = "Account Update";
include('templates/header.php');
?>
<?
	$db = new pdo_Database(DB_HOST, DB_NAME, DB_USER, DB_PASS);
	$sql="select * from User where UserName = :username";
	$db->query($sql);
	$db->bind(":username", $_SESSION['username'], PDO::PARAM_STR);
	$db->execute();
	$row=$db->single();
	
	$ID = $row['ID'];
	$username = $row['UserName'];

?>
<div class="container">
<br>
    <div class="page-header">
	        <h1><?=$pageTitle;?></h1>
    </div>
	<form id="account" method="post" action="<? echo $update; ?>">

		<h3>Username</h3>
			<div class="row">
				<div class="col-md-12">
					<div class="input-group">
						<span class="input-group-addon" id="basic-addon1">User Name</span>
						<input type="text" name="username" id="username" class="form-control"  aria-describedby="basic-addon1" value="<?php echo $username; ?>">
                    	<input type="hidden"  id="originalName" value="<?php echo $username; ?>">
					</div>
				</div>
			</div>

        <h3>New Password</h3>
        	<div class="row">
				<div class="col-md-12">
					<div class="input-group">
						<span class="input-group-addon" id="basic-addon1">New Password</span>
						<input type="password" id="pass" name="password" class="form-control"  aria-describedby="basic-addon1">
					</div>
				</div>
			</div>

		<h3>Confirm Password</h3>
			<div class="row">
				<div class="col-md-12">
					<div class="input-group">
						<span class="input-group-addon">Confirm Password</span>
						<input type="password" id="cpass" name="cpassword" class="form-control"  aria-describedby="basic-addon1">
					</div>
				</div>
			</div>


		<br>
        <div>
			<input type="hidden" name="ID"  value="<?php echo $ID; ?>" />
            <input  class="btn btn-lg btn-primary center-block" id="submit-button" type="submit" value="submit" />
        </div>
	</form>
	</div>  <!-- end of container-->
<script>
	$('.list-search').hide();
</script>
<?
include('templates/footer.php');
?>