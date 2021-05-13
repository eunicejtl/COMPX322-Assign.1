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

	//GET VARIABLES VALUES USING POST
	$townToRemove = $_POST['selectedTown'];
	$username = $_POST["usernameValue"];
	
	//GET USER ID USING USERNAME IN DATABASE
	$getID = "SELECT * FROM `users` WHERE `username` = '$username'";
	$getIdresult = $con ->query($getID);

	//CHECK IF THERE'S ERROR IN QUERY, 
	if($getIdresult != FALSE) {
		while($rowId = $getIdresult->fetch()) {
			$id = $rowId['uid'];
		}
	}
	else
		die ("Error in database query. Cannot get user id.");
	

	//DELETE SELECTED TOWN FROM USER'S LIST OF TOWNS
	//(NOTHING HAPPENS IF USER SELECTS A TOWN THAT'S NOT IN THEIR LIST)
	$removeValues = "DELETE FROM `join` WHERE `town` = '$townToRemove' AND `uid` = '$id'";
	$removeResult = $con ->query($removeValues);

	if($removeResult != FALSE) {
		$removeResult->fetch();
		echo $id;
	}
	else 
		die("Error in database query. Cannot remove from the database.");
?>	