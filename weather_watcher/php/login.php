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
	$username = $_POST["usernameValue"];
	$password = $_POST["passwordValue"];

	$query = "SELECT * FROM `Users` WHERE username = '$username' AND password = '$password'";
	$result = $con->query($query);

	//CHECK IF THERE'S ERROR IN THE QUERY
	if ($result != FALSE)
	{
		$row = $result->fetch();
		if(!empty($row)) {
			//GET DATA FROM DB
			echo $row["uid"];
			return;
		}
		else
			echo "No data";
	}
	else
		die("Error in Database Query.");
?>