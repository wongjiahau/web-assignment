<html>
	<body>
		<header>Welcome to AAA Movie Library</header>
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
	$query = "select count(*) as count from video;";
	$result = mysqli_query($conn, $query);
	if (!$result) {
		$message = 'Invalid query: ' . mysqli_error() . "\n";
		$message .= 'Whole query: ' . $query;
		echo $message;
		die($message);
	}
	while ($row = mysqli_fetch_assoc($result)) {
		echo "There are ".$row['count']." movies";
	}
	mysqli_close($conn);
	?>
	</body>
</html>
