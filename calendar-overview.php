<?
define('TRO_ADS',true);
include('init.php');
$db = new pdo_Database(DB_HOST, DB_NAME, DB_USER, DB_PASS);
$insert = INCLUDES_URL.'/booking-insert.php';


$addStyleSheet[] = templateAddStyleSheet("//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.10.0/css/bootstrap-select.min.css");
$addStyleSheet[] = templateAddStyleSheet(CSS_URL."/bootstrap-datepicker.min.css");
$addStyleSheet[] = templateAddStyleSheet(CSS_URL."/fullcalendar.css");
$addStyleSheet[] = templateAddStyleSheet(CSS_URL."/dashboard.css");
$addScript[] = templateAddScript("//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.10.0/js/bootstrap-select.min.js");
$addScript[] = templateAddScript(JS_URL."/bootstrap-datepicker.min.js");
$addScript[] = templateAddScript(JS_URL."/moment.min.js");
$addScript[] = templateAddScript(JS_URL."/fullcalendar.min.js");


$pageTitle = "Global Calendar";
include('templates/header-calendar.php');
?>

           
	<!--Change different setup here for different sidebar items-->
	
	<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
	  <h2 class="sub-header">Setup</h2> 
		<p>Use the top right arrow to select the calendar to be reviewed.</p>
    	<p></p>
	
	  <h2 class="page-header">Calendar</h2>
    	<div align="center">
		<iframe src="https://calendar.google.com/calendar/embed?title=Global%20Calendar&amp;showPrint=0&amp;height=800&amp;wkst=1&amp;bgcolor=%23FFFFFF&amp;src=a8bejd0033t591ho95updb1btk%40group.calendar.google.com&amp;color=%23333333&amp;src=98jsrnbpcu6ibjh8f4gice0j5s%40group.calendar.google.com&amp;color=%23B1365F&amp;src=qfs82hden519fnit1n3leia1ok%40group.calendar.google.com&amp;color=%23125A12&amp;src=gdpfiud0dh0td5f082hmni0424%40group.calendar.google.com&amp;color=%2323164E&amp;src=4g4ilt3occ8hdlch7lvresmfpk%40group.calendar.google.com&amp;color=%23853104&amp;ctz=America%2FNew_York" style="border-width:0" width="800" height="800" frameborder="0" scrolling="no"></iframe>
        </div>
	</div>


<?
include('templates/footer-calendar.php');
?>