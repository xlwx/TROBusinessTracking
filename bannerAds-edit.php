<?
define('TRO_ADS',true);
include('init.php');
$update = INCLUDES_URL.'/bannerAds-update.php';

$addScript[] = templateAddScript(JS_URL."/bannerAds-edit-validation.js");
$pageTitle = "BannerAds Edit";
include('templates/header.php');
?>

	<?
		$db = new pdo_Database(DB_HOST, DB_NAME, DB_USER, DB_PASS);
		$sql="select * from bannerAds where Name = :name";
		$db->query($sql);
		$db->bind(":name", $_GET['name'], PDO::PARAM_STR);
		$db->execute();
		$row=$db->single();
		
		$bannerID = $row['BannerID'];
		$name = $row['Name'];
		$value = $row['Value'];
		$runPeriod = $row['RunPeriod'];
		$availableUnits = $row['AvailableUnits'];



	?>


	<div class="container">
	<br>
    <div class="page-header">
	        <h1><?echo $pageTitle;?></h1>
    </div>
	<form id="bannerAds" method="post" action="<? echo $update; ?>">

		<h3>Name</h3>
			<div class="row">
				<div class="col-md-12">
					<div class="input-group">
						<span class="input-group-addon" id="basic-addon1">Name</span>
						<input type="text" name="name" id="name" class="form-control"  aria-describedby="basic-addon1" value="<?php echo $name; ?>">
                    	<input type="hidden"  id="originalName" value="<?php echo $name; ?>">
					</div>
				</div>
			</div>

		<h3>Value</h3>
			<div class="row">
				<div class="col-md-12">
					<div class="input-group">
						<span class="input-group-addon" id="basic-addon1">$</span>
						<input type="text" name="value" class="form-control"  aria-describedby="basic-addon1" value="<?php echo $value; ?>">
						<span class="input-group-addon" id="basic-addon1">.00</span>
					</div>
				</div>
			</div>

		<h3>Run Period</h3>
			<div class="row">
				<div class="col-md-12">
					<div class="input-group">
						<span class="input-group-addon" id="basic-addon1">Run Period</span>
						<select name="runPeriod" id="runPeriod" required class="form-control"  aria-describedby="basic-addon1">
							<option value="">None</option>
							<option value = "1">1</option>
							<option value = "15">15</option>
							<option value = "20">20</option>
							<option id="other" value = "other" selected>other</option>
						</select>
						<span class="input-group-addon" id="basic-addon1">weeks</span>
					</div>

					<div type="hide" id="custom" class="input-group">
						<span class="input-group-addon">Input the run period required</span>
						<input type="text" name="customPeriod" id="customPeriod" class="form-control" aria-describedby="basic-addon1" onchange="change()" value="<?php echo $runPeriod; ?>" >
						<span class="input-group-addon">weeks</span>
					</div>

				</div>
			</div>
		<script>
			$("#custom").show();
			$('#runPeriod').change(function(){
				if($(this).val() == 'other'){
					$("#custom").show();
				}else{
					$("#custom").hide();
				}
			});

			function change() {
				var customPeriod = document.getElementById("customPeriod");
				var other = document.getElementById("other");
				other.value = customPeriod.value;
				//alert(other.value);
			}
		</script>

		<h3>Available Units</h3>
					<div class="row">
						<div class="col-md-12">
							<div class="input-group">
								<span class="input-group-addon" id="basic-addon1">Available Units</span>
								<input type="text" name="availableUnits" class="form-control"  aria-describedby="basic-addon1" value="<?php echo $availableUnits; ?>" >
							</div>
						</div>
					</div>


		<br>
        <div>
            <input type="hidden" name="ID"  value="<?php echo $bannerID; ?>" />
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