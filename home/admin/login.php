<?php
require('./../util/connect.php');
if (!$conn) {
    die("Database connection failed." . mysqli_error($conn));
}
session_start();
if (isset($_POST['admin_id']) and isset($_POST['password'])) {
    $admin_id = $_POST['admin_id'];
    $password = $_POST['password'];
    $query = "SELECT password_hash FROM `admin_data` WHERE admin_id='$admin_id';";
    $result = mysqli_query($conn, $query) or die(mysqli_error($conn));
    $count = mysqli_num_rows($result);
	while ($row = mysqli_fetch_assoc($result)) {
        $password_hash = $row['password_hash'];
    }
    if(password_verify($password, $password_hash)){
        $_SESSION['admin_id'] = $admin_id;
    } else {
        unset($_SESSION['admin_id']);
        $error = "Invalid login credentials";
        echo $error;
    }
    if(isset($_SESSION['admin_id'])) {
        header("Location: home.php");
        die();
        $admin_id = $_SESSION['admin_id'];
        echo "Hi".$usrname;
        echo "<a href='logout.php'>Logout</a>";

    }
}
?>
<html>

<body>
    <form method="POST">
        <h2>Please Login</h2>
        <input id="adminId" type="text" name="admin_id" placeholder="Admin ID" required>
        <br>
        <input type="password" name="password" id="inputPassword" placeholder="Password" required>
        <br>
        <button type="submit">Login</button>
        <a href="register.php">Register</a>
    </form>
</body>

</html>
