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
	$(".column").height($("body").height());
	
	charts = $.initMetrics();
});
</script>
</head>
<body>
<h1>Prepress Metricboard</h1>
<div class="column" id="column1">
	<div class="widget textList" id="recentUploads" style="margin-bottom: 15%;" widget="textList" refresh-url="<?=$fileDropURL;?>/config/metricboardPoll/fileList.php" refresh-rate="3" max="10" key="3898326d690eacbb8cad7900f9c63e736cc79e4b">
		<span class="header">Recent Uploads</span>
		<ul>
		</ul>
	</div>
	<div class="fLeft widget halfWidth" id="numNonDownloaded" widget='number' refresh-url="<?=$fileDropURL;?>/config/metricboardPoll/numFiles.php" refresh-rate="3" key="3898326d690eacbb8cad7900f9c63e736cc79e4b">
		<span class='numberNumber'>0</span>
		<span class='numberText'>new files</span>
	</div>
	<div class="fLeft widget halfWidth" id="numUsers" widget='number' refresh-url="<?=$fileDropURL;?>/config/metricboardPoll/loggedUsers.php" refresh-rate="3" key="3898326d690eacbb8cad7900f9c63e736cc79e4b">
		<span class='numberNumber'>0</span>
		<span class='numberText'>users logged in</span>
	</div>
	<div class="clear"></div>
</div>
<div class="column" id="column2">
	<div class='widget oneThirdHeight' id='dailyUploads' widget='singleLine'>
		<ul class='slData'>
			<li><span class='slColumn'>Sunday</span><span class='slValue'>3</span></li>
			<li><span class='slColumn'>Monday</span><span class='slValue'>8</span></li>
			<li><span class='slColumn'>Tuesday</span><span class='slValue'>6</span></li>
			<li><span class='slColumn'>Wednesday</span><span class='slValue'>7</span></li>
			<li><span class='slColumn'>Thursday</span><span class='slValue'>5</span></li>
			<li><span class='slColumn'>Friday</span><span class='slValue'>9</span></li>
			<li><span class='slColumn'>Saturday</span><span class='slValue'>4</span></li>
		</ul>
	</div>
	<div class='widget oneThirdHeight' id='monthlyUploads' widget='singleLine'>
		<ul class='slData'>
			<li><span class='slColumn'>June</span><span class='slValue'>100</span></li>
			<li><span class='slColumn'>July</span><span class='slValue'>150</span></li>
			<li><span class='slColumn'>August</span><span class='slValue'>160</span></li>
			<li><span class='slColumn'>September</span><span class='slValue'>120</span></li>
			<li><span class='slColumn'>October</span><span class='slValue'>90</span></li>
			<li><span class='slColumn'>November</span><span class='slValue'>110</span></li>
			<li><span class='slColumn'>December</span><span class='slValue'>100</span></li>
		</ul>
	</div>
	<div class='widget oneThirdHeight' id='dailyUploads3' widget='singleLine'>
		<ul class='slData'>
			<li><span class='slColumn'>Sunday</span><span class='slValue'>3</span></li>
			<li><span class='slColumn'>Monday</span><span class='slValue'>8</span></li>
			<li><span class='slColumn'>Tuesday</span><span class='slValue'>6</span></li>
			<li><span class='slColumn'>Wednesday</span><span class='slValue'>7</span></li>
			<li><span class='slColumn'>Thursday</span><span class='slValue'>5</span></li>
			<li><span class='slColumn'>Friday</span><span class='slValue'>9</span></li>
			<li><span class='slColumn'>Saturday</span><span class='slValue'>4</span></li>
		</ul>
	</div>
	<div class="clear"></div>
</div>
<div class="column lastColumn" id="column3">
	<div class="widget textList" id="schedule" style="margin-bottom: 15%" widget="textList" useID="" refresh-url="dataGrabbers/schedule.php" refresh-rate="30" max="15">
		<span class="header">Schedule</span>
		<ul>
		</ul>
	</div>
</div>
<div class="clear"></div>
</body>
</html>
