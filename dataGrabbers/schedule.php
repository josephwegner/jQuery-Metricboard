<?

	if(!is_numeric($_POST['count'])) die();

	//connect to DB
	$db_conn = mssql_connect("192.2.40.76\Presidio", "sa", "Password!") or die("Error connecting to server (mssql_connect)");

	// Select DB
	mssql_select_db("PSI", $db_conn) or die("Error choosing database (mssql_select_db)");

	// Query DB
	$sql = "SELECT TOP ".$_POST['count']." * FROM vwListViewMilestoneSche WHERE lMilestoneKey = 1123 ORDER BY dtScheduled ASC";
	
	$query_result = mssql_query($sql);

	$ret = new StdClass();
	$ret->items = array();

	while($row = mssql_fetch_array($query_result)) {
		$html  = "<li>\n";
		$html .= "	<span class='fLeft'>".$row['sJobNumber']." - ".$row['sName1']."</span>\n";
		$html .= "	<span class='fRight highlight'>".date('n-j-y', strtotime($row['dtScheduled']))."</span>\n";
		$html .= "	<div class='clear'></div>\n";
		$html .= "</li>\n";

		array_push($ret->items, $html);
	}

	echo json_encode($ret);
?>
