<?php
class Paginator {
    private $_dbconn;
    private $_query;
    private $_result;
    private $_totalPages;

    public function __construct($dbconn, $query) {
        $this->_dbconn = $dbconn;
        $this->_query = $query;
    }

    public function getData($page = 0, $limit = 10) {

    }

    public function countifyQuery($query) {
        $toks = explode(" ", $query);
        $res = array();
        $startToSelect = false;
        foreach($toks as $x) {
            if($startToSelect) {
                array_push($res, $x);
            }
            if(strtolower($x) == "from") {
                $startToSelect = true;
            }
        }
        return "select count(*) from " . implode(" ", $res);
    }

    public function toString() {
        return "hello";
    }
}
?>