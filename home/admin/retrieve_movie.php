<html>
    <body>
        <h1>retrieve movie</h1>
        <?php
        require($_SERVER['DOCUMENT_ROOT'] . "/home/util/connect.php");
        $query = "select * from video;";
        $result = mysqli_query($conn, $query);
        if (!$result) {
            $message = 'Invalid query: ' . mysqli_error() . "\n";
            $message .= 'Whole query: ' . $query;
            echo $message;
            die($message);
        }
        while ($row = mysqli_fetch_assoc($result)) {
            echo "" . $row['title'] . " <br>";
        }
        mysqli_close($conn);
        ?>
    </body>
</html>