<html>
	<body>
		<header>Welcome to AAA Movie Library</header>
		<?php
	require("./util/connect.php");
	$query = "select * from video;";
	$result = mysqli_query($conn, $query);
	if (!$result) {
		$message = 'Invalid query: ' . mysqli_error() . "\n";
		$message .= 'Whole query: ' . $query;
		echo $message;
		die($message);
	}
	while ($row = mysqli_fetch_assoc($result)) {
		echo "".$row['title']." <br>";
	}
	mysqli_close($conn);
	?>
	</body>
</html>
