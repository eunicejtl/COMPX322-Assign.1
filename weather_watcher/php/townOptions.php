<?php 

	//ERROR LOGGING
	ini_set("error_reporting", E_ALL);
	ini_set("log_errors", "1");
	ini_set("error_log", "php_error.txt");

	//CONNECT TO THE DATABASE
	//require_once('dbconnect.php');
	require_once('homedbconnect.php');

	$query = "select * from `weather`";
	$result = $con ->query($query);
	
	//DISPLAY LIST OF TOWNS FROM DATABASE
	if($query != FALSE) {
		while($row = $result->fetch()) {
			$town = $row['town'];
			echo '<option value ="'.$town.'">';
			echo $town;
			echo "</option>";
		}
	}
	else
		die ("Error in database query.");

?>