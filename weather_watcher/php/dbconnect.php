<?php 
	try {
		$con = new PDO('mysql:host=mysql.cms.waikato.ac.nz; dbname=ejl24', 'ejl24', 'my10927777sql');
	}
	catch(PDOException $e) {
		echo "Database connection error " . $e->getMessage();
	}
?>