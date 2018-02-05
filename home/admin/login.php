<?php
require('./../util/connect.php');
if (!$conn) {
    die("Database connection failed." . mysqli_error($conn));
}
session_start();
if (isset($_POST['username']) and isset($_POST['password'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $query = "SELECT * FROM `admin_data` WHERE admin_id='$username' AND password_hash='$password';";
    $result = mysqli_query($conn, $query) or die(mysqli_error($conn));
    $count = mysqli_num_rows($result);
	while ($row = mysqli_fetch_assoc($result)) {
		echo "".$row['title']." <br>";
	}
    if ($count == 1) {
        $_SESSION['username'] = $username;
    } else {
        $error = "Invalid login credentials";
    }
    if(isset($_SESSION['username'])) {
        $username = $_SESSION['username'];
        echo "Hi".$usrname;
        echo "<a href='logout.php'>Logout</a>";

    }
}
?>
<html>

<body>
    <form class="form-signin" method="POST">
        <h2 class="form-signin-heading">Please Login</h2>
        <div class="input-group">
            <span class="input-group-addon" id="basic-addon1">@</span>
            <input type="text" name="username" class="form-control" placeholder="Username" required>
        </div>
        <label for="inputPassword" class="sr-only">Password</label>
        <input type="password" name="password" id="inputPassword" class="form-control" placeholder="Password" required>
        <button class="btn btn-lg btn-primary btn-block" type="submit">Login</button>
        <a class="btn btn-lg btn-primary btn-block" href="register.php">Register</a>
    </form>
</body>

</html>
