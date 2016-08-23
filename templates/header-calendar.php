<?
session_start();
if(!isset($_SESSION['id'])){
	header("Location:".BASE_URL."signin.php");
}
$username = $_SESSION['username'];
$admin = $_SESSION['admin'];
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?=$pageTitle?></title>	
<!--Animate-->
	<link rel="stylesheet" href="<? echo CSS_URL; ?>/animate.min.css">	
<!--CSS-->
	<!--bootstrap-->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">
	<!--Calendar style-->
	<style>
		body {
		margin: 40px 30px;
		padding: 0;
		font-family: \"Lucida Grande\",Helvetica,Arial,Verdana,sans-serif;
		font-size: 14px;
		}

		#calendar {
			max-width: 900px;
			margin: 0 auto;
		}
	</style>
<?
templateRenderStyleSheet($addStyleSheet);
templateRenderStyle($addStyle);
?>   

<!--JavaScraip-->
	<!--jquery-->
    <script src="http://code.jquery.com/jquery-2.2.3.min.js"></script>
	<!---validation-->
	<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.15.0/jquery.validate.min.js"></script>
	<!--bootstrap-->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
<?
templateRenderScript($addScript);
templateRenderJavaScript($addJavaScript);
?>
 <!--Style of the Quick Booking div-->
<style>
  .fixedbutton {
    position: fixed;
    top: 20%;
  	right: 0%;
  	background-color:#a59fb1;
  	z-index:100;
}	
</style>
  </head>
<?

	$db = new pdo_Database(DB_HOST, DB_NAME, DB_USER, DB_PASS);
	$sql = "SELECT * FROM User WHERE UserName=:username ";
	$db->query($sql);
	$db->bind(':username', $username, PDO::PARAM_STR);
	$db->execute();
	$row = $db->single();
	$salesMemberID = $row['SalesMemberID'];
	
	$sql = "SELECT * FROM salesTeam WHERE ID=:ID ";
	$db->query($sql);
	$db->bind(':ID', $salesMemberID, PDO::PARAM_STR);
	$db->execute();
	$row = $db->single();
	$firstname = $row['FirstName'];	
	$cellphone = $row['CellPhone'];
	$user_edit = BASE_URL . 'salesTeam-edit.php' . '?firstname=' . $firstname . '&cellphone=' . $cellphone;
	$logout = INCLUDES_URL  .'/'.  'logout.php';
	$account_edit = BASE_URL  .'/'.  'account-edit.php';
?>

  <body>
  <!-- Static navbar -->
  <div id='qbboard' class='fixedbutton admin' hidden>
  		<h4>Quick Booking</h4>
  		<div class="list-group">
  		<a href="<? echo BASE_URL;?>booking-add.php" class="list-group-item">Website Ads</a>
    	<a href="<? echo BASE_URL;?>emailBroadcast-add.php" class="list-group-item">Email Broadcast</a>
  		<a href="<? echo BASE_URL;?>troTravelgram-add.php" class="list-group-item">TroTravelgram</a>
    	<a href="<? echo BASE_URL;?>troCruiseNews-add.php" class="list-group-item">TroCruiseNews</a>
        <a href="<? echo BASE_URL;?>travelAgentSpotlight-add.php" class="list-group-item">TravelAgentSpotlight</a>
		</div>
 	</div>
 <img src="<?echo IMAGE_URL?>/arrowLeft.png" alt="Quick Booking" id='qb' style="width:40px;height:40px;top:20%;right:0%;position:fixed" class="admin">
  <script>
  	$('#qb').hover(
    	//handleIn
    	function(){
        	$('#qbboard').removeClass('bounceOutRight');
        	$('#qbboard').addClass('animated bounceInRight');
    		$('#qbboard').show();
    	},
    	//handleOut
    	function(){
    	}
    );
  	
  	$('#qbboard').hover(
    	//handleIn
    	function(){
    	},
    	//handleOut
    	function(){
        	$('#qbboard').addClass('bounceOutRight');
    		//$('#qbboard').hide();
    	}
    );
  </script>
  
   <!----------------------------------Advanced Search--------------------------------------------->
  <div id='advboard' class='fixedbutton admin' style='top:30%' hidden>
  	<h4>Advanced Search</h4>
  	<div class="list-group">
  	<a href="<? echo BASE_URL;?>booking-advancedSearch.php" class="list-group-item">Website Ads</a>
    <a href="<? echo BASE_URL;?>emailBroadcast-advancedSearch.php" class="list-group-item">Email Broadcast</a>
  	<a href="<? echo BASE_URL;?>troTravelgram-advancedSearch.php" class="list-group-item">TroTravelgram</a>
    <a href="<? echo BASE_URL;?>troCruiseNews-advancedSearch.php" class="list-group-item">TroCruiseNews</a>
    <a href="<? echo BASE_URL;?>travelAgentSpotlight-advancedSearch.php" class="list-group-item">TravelAgentSpotlight</a>
	</div>
 </div>	
 
  <!--<button id='qb' class='fixedbutton admin'>Quick Booking</button>-->
  <img src="<?echo IMAGE_URL?>/arrowLeft.png" alt="Advanced Search" id='adv' style="width:40px;height:40px;top:30%;right:0%;position:fixed" class="admin">
  <script>
  	$('#adv').hover(
    	//handleIn
    	function(){
        	$('#advboard').removeClass('bounceOutRight');
        	$('#advboard').addClass('animated bounceInRight');
    		$('#advboard').show();
    	},
    	//handleOut
    	function(){
    	}
    );
  	
  	$('#advboard').hover(
    	//handleIn
    	function(){
    	},
    	//handleOut
    	function(){
        	$('#advboard').addClass('bounceOutRight');
    		//$('#qbboard').hide();
    	}
    );
  </script>
<!----------------------------------Advanced Search End--------------------------------------------->  
  
   
      <nav class="navbar navbar navbar-inverse navbar-fixed-top">
        <div class="container-fluid">
          <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">TRO</a>
          </div>
          <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
              <li><a href="<? echo BASE_URL;?>coverpage.php">Home</a></li>
             <!-- <li><a href="#">About</a></li> -->
              <li><a href="<? echo BASE_URL;?>calendar-overview.php">Calendar</a></li>
              <li class='admin'><a href="<? echo BASE_URL;?>emailBroadcast-list.php">Eamil Broadcast</a></li>
              <li  class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Management <span class="caret"></span></a>
                <ul class="dropdown-menu">
                  <li><a href="<? echo BASE_URL;?>supplier-list.php">Supplier</a></li>
                  <li class='admin'><a href="<? echo BASE_URL;?>salesTeam-list.php">SalesTeam</a></li>
                  <li role="separator" class="divider"></li>
                  <li class="dropdown-header">Advertisement</li>
                  <li><a href="<? echo BASE_URL;?>bannerAds-list.php">BannerAds</a></li>
                  <li><a href="<? echo BASE_URL;?>articles-list.php">SponsorAds</a></li>
                </ul>
              </li>
            	
               <li class="dropdown admin">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Booking <span class="caret"></span></a>
                <ul class="dropdown-menu">
                  <li><a href="<? echo BASE_URL;?>booking-list.php">Website Ads</a></li>
                  <li><a href="<? echo BASE_URL;?>troTravelgram-list.php">TRO Travelgram</a></li>
                  <li><a href="<? echo BASE_URL;?>troCruiseNews-list.php">TRO CruiseNews</a></li>
                  <li><a href="<? echo BASE_URL;?>travelAgentSpotlight-list.php">Travel Agent Spotlight</a></li>
                </ul>
              </li>
            
              <li class='admin'><a href="<? echo BASE_URL;?>googleCalendarShow.php">Google Calendar</a></li>
            </ul>
          
           <ul class="nav navbar-nav navbar-right">
            	 <li class="dropdown">
                	<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?echo $username;?> <span class="caret"></span></a>
                <ul class="dropdown-menu">
                  <li><a href="<?echo $account_edit;?>">Account Setup</a></li>
                  <li><a href="<?echo $user_edit;?>">Persional Info</a></li>
                  <li><a href="<?echo $logout;?>">Log out</a></li>
                </ul>
              	</li>	
      		</ul>
          </div><!--/.nav-collapse -->
        </div><!--/.container-fluid -->
      </nav>	
   
		<div class="container-fluid">
		  <div class="row">
			<div class="col-sm-3 col-md-2 sidebar">
			  <ul class="nav nav-sidebar">
				<li ><a href="<? echo BASE_URL;?>calendar-overview.php">Overview </a></li>
				<li ><a href="<? echo BASE_URL;?>calendar-supplier.php">Supplier</a></li>
				<li ><a href="<? echo BASE_URL;?>calendar-sponsorAds.php">Sponsor Ads</a></li>
				<li ><a href="<? echo BASE_URL;?>calendar-bannerAds.php">Banner Ads</a></li>
				<li ><a href="<? echo BASE_URL;?>calendar-emailBroadcast.php">Email Broadcast</a></li>
				<li ><a href="<? echo BASE_URL;?>calendar-troTravelgram.php">TRO Travelgram</a></li>
				<li ><a href="<? echo BASE_URL;?>calendar-troCruiseNews.php">TRO CruiseNews</a></li>
              	<li ><a href="<? echo BASE_URL;?>calendar-travelAgentSpotlight.php">Travel Agent Spotlight</a></li>
			  </ul>
			</div>
		<!--End of div container-fluid is in footer-calendar.php-->
     
  <script>
  
  	var url = window.location;
	// Will only work if string in href matches with location
	$('ul.nav  a[href="'+ url +'"]').parent().addClass('active');
	// Will also work for relative and absolute hrefs
	$('ul.nav a').filter(function() {
    	return this.href == url;
	}).parent().addClass('active');
  	
  	if('<?echo $_SESSION['admin'];?>' === 'no'){
    	$('.admin').hide();    	
    }
  </script>
<!-- EH -->
