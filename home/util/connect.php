<?php
require($_SERVER['DOCUMENT_ROOT'] . "/home/util/log_console.php");
$dbpass = file_get_contents("/dbpass.txt");
$dbpass = substr($dbpass, 0, -1); // Because an invisible character need to be omitted 
$dbhost = 'localhost';
$dbuser = 'root';
$dbname = "aml";
$conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
if (!$conn) {
	echo "Error";
	die('Could not connect: ' . mysqli_error());
} else {
	log_console('Connected successfully to database');
}
?>