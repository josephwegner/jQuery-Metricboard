<!DOCTYPE html>

<?
	require_once("config.php");
?>

<html>
<head>
<title>Prepress Metricboard</title>
<link href='http://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet' type='text/css'>
<link type="text/css" rel="stylesheet" href="css/dashboard.css" />
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
<script type="text/javascript" src="scripts/highcharts/js/highcharts.js"></script>
<script type="text/javascript" src="scripts/widgets.js"></script>
<script type="text/javascript">
var charts;
$(document).ready(function() {
//	$(".column").height($("body").height());
	
	charts = $.initMetrics();
});
</script>
</head>
<body>
<h1>Metricboard</h1>
<div class="column" id="column1">
	<div class="widget textList" id="recentUploads" style="margin-bottom: 15%;" widget="textList" refresh-url="dataGrabbers/listExample.php" refresh-rate="3" max="10" key="123456">
		<span class="header">Recent Uploads</span>
		<ul>
		</ul>
	</div>
	<div class="fLeft widget halfWidth" id="numNonDownloaded" widget='number' refresh-url="dataGrabbers/countExample.php" refresh-rate="3" key="123456">
		<span class='numberNumber'>0</span>
		<span class='numberText'>new files</span>
	</div>
	<div class="fLeft widget halfWidth" id="numUsers" widget='number' refresh-url="dataGrabbers/countExample.php" refresh-rate="3" key="123456">
		<span class='numberNumber'>0</span>
		<span class='numberText'>users logged in</span>
	</div>
	<div class="clear"></div>
</div>
<div class="column" id="column2">
	<div class="widget halfHeight" id="operationPercent" widget="pieChart" refresh-url="dataGrabbers/pieExample.php" refresh-rate="3" title="Daily Activity">
	</div>
	<div class="widget textList" id="proofsOut" style="margin-bottom: 15%" widget="textList" useID="" refresh-url="dataGrabbers/listExample.php" refresh-rate="30" max="7">
		<span class="header">Proofs Out</span>
		<ul>
		</ul>
	</div>
	<div class="clear"></div>
</div>
<div class="column lastColumn" id="column3">
	<div class="widget textList" id="schedule" style="margin-bottom: 15%" widget="textList" useID="" refresh-url="dataGrabbers/listExample.php" refresh-rate="30" max="15">
		<span class="header">Schedule</span>
		<ul>
		</ul>
	</div>
</div>
<div class="clear"></div>
</body>
</html>
