<?
	//session_start();
	 if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 
	define('TRO_ADS',true);
	include('init.php');
	
	//print_r($_SESSION);
	$username = $_SESSION['username'];
	$admin = $_SESSION['admin'];
	
	$db = new pdo_Database(DB_HOST, DB_NAME, DB_USER, DB_PASS);
	$sql = "SELECT * FROM User WHERE UserName=:username ";
	$db->query($sql);
	$db->bind(':username', $username, PDO::PARAM_STR);
	$db->execute();
	$row = $db->single();
	$salesMemberID = $row['SalesMemberID'];
	//$admin = $row['Admin'];
    
	$data = '?username=' . $username . '&admin=' . $admin;
	
	$sql = "SELECT * FROM salesTeam WHERE ID=:ID ";
	$db->query($sql);
	$db->bind(':ID', $salesMemberID, PDO::PARAM_STR);
	$db->execute();
	$row = $db->single();
	$firstname = $row['FirstName'];	
	$cellphone = $row['CellPhone'];
	$user_edit = BASE_URL . '/salesTeam-edit.php' . '?firstname=' . $firstname . '&cellphone=' . $cellphone;
	$logout = INCLUDES_URL  .'/'.  'logout.php';
	$account_edit = BASE_URL  .'/'.  'account-edit.php';
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="chenqi_zhang">
    

    <title>Travel Research Online</title>

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">

    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <link href="<? echo CSS_URL; ?>/ie10-viewport-bug-workaround.css" rel="stylesheet">
  	<!--Animate-->
	<link rel="stylesheet" href="<? echo CSS_URL; ?>/animate.min.css">
    <!-- Custom styles for this template -->
    <link href="<? echo CSS_URL; ?>/jumbotron.css" rel="stylesheet">
  </head>

  <body>

    <nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="http://www.travelresearchonline.com/blog/">TRO</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
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
        </div><!--/.navbar-collapse -->
      </div>
    </nav>

    <!-- Main jumbotron for a primary marketing message or call to action -->
    <div class="jumbotron">
      <div class="container">
        <h1 class='animated rubberBand'>Hello, TRO!</h1>
        <p class='animated bounceInLeft'>Welcome to use this system.</p>
        <p class='animated bounceInLeft'><a class="btn btn-primary btn-lg" href="http://www.travelresearchonline.com/blog/" role="button">Go To TRO Website &raquo;</a></p>
      </div>
    </div>

    <div class="container">
      <!-- Example row of columns -->
      <div class="row animated fadeInDown">
        <div class="col-md-4">
          <h2>Supplier</h2>
          <p> Supplier Management </p>
          <p><a class="btn btn-default" href="<? echo BASE_URL; ?>supplier-list.php" role="button">View details &raquo;</a></p>
        </div>
        <div class="col-md-4">
          <h2>SponsorAds</h2>
          <p> SponsorAds Management </p>
          <p><a class="btn btn-default" href="<? echo BASE_URL; ?>articles-list.php" role="button">View details &raquo;</a></p>
       </div>
        <div class="col-md-4">
          <h2>BannerAds</h2>
          <p> BannerAds Management</p>
          <p><a class="btn btn-default" href="<? echo BASE_URL; ?>bannerAds-list.php" role="button">View details &raquo;</a></p>
        </div>
      </div>
	  
	   <div class="row animated fadeInDown">
        <div class="col-md-4">
          <h2>Calendar</h2>
          <p> Global Calendar </p>
          <p><a class="btn btn-default" href="<? echo BASE_URL; ?>calendar-overview.php" role="button">View details &raquo;</a></p>
        </div>
        <div class="col-md-4 admin">
          <h2>TRO Cruise News</h2>
          <p> TRO Cruise News Booking  </p>
          <p><a class="btn btn-default" href="<? echo BASE_URL; ?>troCruiseNews-list.php" role="button">View details &raquo;</a></p>
       </div>
        <div class="col-md-4 admin">
          <h2>TRO Travelgram</h2>
          <p> TRO Travelgram Booking  </p>
          <p><a class="btn btn-default" href="<? echo BASE_URL; ?>troTravelgram-list.php" role="button">View details &raquo;</a></p>
        </div>
      </div>
	  
	  <div class="row admin animated fadeInDown">
        <div class="col-md-4">
          <h2>Email Broadcast</h2>
          <p> Email Broadcast Management </p>
          <p><a class="btn btn-default" href="<? echo BASE_URL; ?>emailBroadcast-list.php" role="button">View details &raquo;</a></p>
        </div>
        <div class="col-md-4">
          <h2>Booking</h2>
          <p> TRO Website Ads Booking </p>
          <p><a class="btn btn-default" href="<? echo BASE_URL; ?>booking-list.php" role="button">View details &raquo;</a></p>
       </div>
	   <div class="col-md-4">
          <h2>Sales Team</h2>
          <p> Sales Team Management </p>
          <p><a class="btn btn-default" href="<? echo BASE_URL; ?>salesTeam-list.php" role="button">View details &raquo;</a></p>
       </div>
	  </div>
       
      <div class="row admin animated fadeInDown">
        <div class="col-md-4">
          <h2>Travel Agent Spotlight</h2>
          <p> Travel Agent Spotlight </p>
          <p><a class="btn btn-default" href="<? echo BASE_URL; ?>travelAgentSpotlight-list.php" role="button">View details &raquo;</a></p>
        </div>
	  </div>
      
    </div> <!-- /container -->
	<hr>
	<footer>
		<p>&copy; 2016 Travel Research Online.</p>
     </footer>
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="js/vendor/jquery.min.js"><\/script>')</script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="<? echo JS_URL; ?>/ie10-viewport-bug-workaround.js"></script>
    <script>
    	if('<?echo $admin;?>' === 'no'){
        	$('.admin').hide();
        }
    </script>
  </body>
</html>
