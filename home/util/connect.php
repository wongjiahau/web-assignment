<?php
	$dbhost = 'localhost';
	$dbuser = 'root';
	$dbpass = '842684268426';
	$dbname = "aml";
    $conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
	if (!$conn) {
		die('Could not connect: ' . mysqli_error());
	} else {
		echo 'Connected successfully to database<br>';
    }
?>