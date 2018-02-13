<?php
class DbLink
{
    private $conn;
    public function __construct()
    {
        $dbpass = file_get_contents("/dbpass.txt");
        $dbpass = substr($dbpass, 0, -1); // Because an invisible character need to be omitted 
        $dbhost = 'localhost';
        $dbuser = 'root';
        $dbname = "aml";
        $this->conn = new mysqli($dbhost, $dbuser, $dbpass, $dbname);
        if (!$this->conn) {
            echo "Error";
            die('Could not connect: ' . mysqli_error());
        } else {
            echo('Connected successfully to database');
        }
    }

    public function sendQuery($query)
    {
        $sql_result = $this->conn->query($query);
        if (!$sql_result) {
            $message = 'Invalid query: ' . mysqli_error() . "\n";
            $message .= 'Whole query: ' . $query;
            echo $message;
            die($message);
        }
        $result = array();
        while ($row = $sql_result->fetch_assoc()) {
            array_push($result, $row);
        }
        return $result;
    }

    public function close() {
        $this->conn->close();
    }
}
?>