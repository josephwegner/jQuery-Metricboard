<?
require_once("../config.php");

$ch = curl_init("/your/url/here");

curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, 'key='.urlencode($_POST['key']));

$data = curl_exec($ch);

curl_close($ch);

echo $data;
?>
