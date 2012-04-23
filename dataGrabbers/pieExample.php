<?

	//connect to DB
	$db_conn = mssql_connect("your/url/here", "user", "password") or die("Error connecting to server (mssql_connect)");

	// Select DB
	mssql_select_db("PSI", $db_conn) or die("Error choosing database (mssql_select_db)");

	// Query DB
	$sql = "SELECT value, label FROM aTable WHERE this='true'";
	
	$query_result = mssql_query($sql);

	$sums = array();

	while($rec = mssql_fetch_array($query_result)) {
		$sums[$rec['label']] = $rec['value'];
	}

	$total = array_sum($sums);

	echo json_encode($sums);
	
?>
