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

	//GET VARIABLE VALUES USING POST
	$townToAdd = $_POST['selectedTown'];
	$username = $_POST["usernameValue"];
	
	//GET USER ID USING USERNAME IN DATABASE
	$getID = "SELECT * FROM `users` WHERE `username` = '$username'";
	$getIdresult = $con ->query($getID);

	if($getIdresult != FALSE) {
		while($rowId = $getIdresult->fetch()) {
			$id = $rowId['uid'];
		}
	}
	else
		die ("Error in database query. Cannot get user id.");
	

	//INSERT TOWN INTO USER'S LIST OF TOWN
	$insertValues = "INSERT INTO `join` (`uid`, `town`) VALUES ('$id', '$townToAdd')";
	$insertResult = $con ->query($insertValues);

	if($insertResult != FALSE) {
		$insertResult->fetch();
		echo $id;
	}
	else 
		die("Error in database query. Cannot insert into the database.");
?>	