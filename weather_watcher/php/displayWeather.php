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

	$id = $_GET["id"];

	$query = "SELECT * FROM `weather` WHERE `town` IN (SELECT `town` FROM `join`WHERE `uid` = $id)";
	$result = $con->query($query);

	if($result != FALSE) {
		while($row = $result->fetch()) {
			//VARIABLES
			$town = $row['town'];
			$current_temp = $row['currTemp'];
			$summary = $row['summary'];

			echo "<tr>";
			//WHEN A TOWN IS CLICKED, SHOW FULL DESCRIPTION
           	echo "<td onclick=showInfo('$town')>$town</td>";
        	echo "<td>$current_temp&deg</td>";
           	echo "<td>$summary</td>";
           	echo "</tr>";
		}
	}
	else 
		die ("Error in Database Query.");
?>