<?
require_once("../config.php");

$ch = curl_init($fileDropURL."/config/metricboardPoll/fileList.php");

curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, 'key='.urlencode($_POST['key'])."&count=".urlencode($_POST['count'])."&lastID=".urlencode($_POST['lastID']));

$data = curl_exec($ch);

curl_close($ch);

echo $data;
?>
