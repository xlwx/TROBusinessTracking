<?
define('TRO_ADS',true);
include('init.php');
$pageTitle = "google calendar";
include('templates/header.php');
?>
<br>
<br>
<br>
<div align="center">

<div>
<!--Booking-->
<iframe src="https://calendar.google.com/calendar/embed?src=8l2dj5ierr04er1uj8tos3lppo%40group.calendar.google.com&ctz=America/New_York" style="border: 0" width="800" height="600" frameborder="0" scrolling="no"></iframe>
</div>
<br>
<div>
<!--EmailBroadcast-->
<iframe src="https://calendar.google.com/calendar/embed?src=l4hbkt5cfq6rpktjb6vbtbeot0%40group.calendar.google.com&ctz=America/New_York" style="border: 0" width="800" height="600" frameborder="0" scrolling="no"></iframe>
</div>
<br>
<div>
<!--TRO CuriseNews-->
<iframe src="https://calendar.google.com/calendar/embed?src=04c9q7jjvihsp1o5rt5u6d2jm4%40group.calendar.google.com&ctz=America/New_York" style="border: 0" width="800" height="600" frameborder="0" scrolling="no"></iframe>
</div>
<br>
<div>
<!--TRO Travelgram-->
<iframe src="https://calendar.google.com/calendar/embed?src=558rp02l805pfl2uj9nu1i5evg%40group.calendar.google.com&ctz=America/New_York" style="border: 0" width="800" height="600" frameborder="0" scrolling="no"></iframe>
</div>


</div>
<script>
	$('.list-search').hide();
</script>
<?
include('templates/footer.php');
?>