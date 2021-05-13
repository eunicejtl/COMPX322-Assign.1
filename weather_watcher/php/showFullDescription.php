<?php

/*NAME: EUNICE JOY LLOBET
ID: 1330233*/

	//ERROR LOGGING
	ini_set("error_reporting", E_ALL);
	ini_set("log_errors", "1");
	ini_set("error_log", "php_error.txt");

	//CONNECT TO THE DATABASE
	//require_once('dbconnect.php');
	require_once('homedbconnect.php');

	//GET VARIABLES VALUE USING POST
	$town = $_POST["townName"];

	$query = "SELECT * FROM `weather` WHERE `town` = '$town'";
	$result = $con->query($query);

	if($result != FALSE) {
		$row = $result->fetch();
		$min_temp = $row['min_temp'];
		$max_temp = $row['max_temp'];
		$outlook = $row['outlook'];
		$tomorrow = $row['tomorrow'];

		echo "<p><h3>Minimum Temperature: </h3>$min_temp&deg</p>";
		echo "<p><h3>Maximum Temperature: </h3>$max_temp&deg</p>";
		echo "<p><h3>Outlook Description: </h3>$outlook</p>";
		echo "<p><h3>Tomorrow: </h3>$tomorrow</p>";

	}
	else 
		die("Error in database query.");
?>