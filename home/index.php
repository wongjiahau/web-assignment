<html>
	<body>
		<header>Welcome to AAA Movie Library</header>
		<?php
define('__ROOT__', dirname(dirname(__FILE__)));
require(__ROOT__.'/src/sample.php');
$x = new Sample();
echo $x->toString();
	?>
	</body>
</html>
