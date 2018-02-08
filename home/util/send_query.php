<?php
function send_query($query)
{
    require($_SERVER['DOCUMENT_ROOT'] . "/home/util/connect.php");
    $sql_result = mysqli_query($conn, $query);
    if (!$sql_result) {
        $message = 'Invalid query: ' . mysqli_error() . "\n";
        $message .= 'Whole query: ' . $query;
        echo $message;
        die($message);
    }
    $result = array();
    while ($row = mysqli_fetch_assoc($sql_result)) {
        array_push($result, $row);
    }
    mysqli_close($conn);
    return $result;
}
?>