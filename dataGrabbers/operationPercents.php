<?

	//connect to DB
	$db_conn = mssql_connect("192.2.40.76\Presidio", "sa", "Password!") or die("Error connecting to server (mssql_connect)");

	// Select DB
	mssql_select_db("PSI", $db_conn) or die("Error choosing database (mssql_select_db)");

	// Query DB
//	$sql = "SELECT SUM(dblDuration) AS sum, sOpDesc FROM vwSNTodaysActivityEmpStatus WHERE lEmployeeKey IN (17,16,21,10,12,8,18) GROUP BY sOpDesc";
	$sql = "SELECT SUM(dblDuration) AS sum, sOpDesc FROM vwSNTodaysActivityEmpStatus WHERE sOpDesc IN ('Digital Prep', 'Commercial Prep', 'Packaging Prep', 'Structural Design') GROUP BY sOpDesc";
	
	$query_result = mssql_query($sql);

	$sums = array();

	while($op = mssql_fetch_array($query_result)) {
		$sums[$op['sOpDesc']] = $op['sum'];
	}

	$total = array_sum($sums);

	$percent = array();

/*	foreach($sums as $op => $time) {
		if(($time / $total) < 0.02) unset($sums[$op]);
	}
*/
	echo json_encode($sums);
	
?>
