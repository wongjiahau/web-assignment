
<?php
if (isset($_SESSION['admin_id'])) {
    header("Location: home.php");
} else {
    header("Location: login.php");
}
?>