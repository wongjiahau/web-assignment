<?php
require_once($_SERVER['DOCUMENT_ROOT'] . "/src/DbLink.php");
class Paginator
{
    private $_dbLink;
    private $_query;
    private $_result;
    private $_totalPages;

    public function __construct($dbLink, $query)
    {
        $this->_dbLink = $dbLink;
        $this->_query = $query;
    }

    public function getData($page = 0, $limit = 10)
    {
    }

    public function getTotalCount()
    {
        return (int)$this->_dbLink
            ->sendQuery(
                $this->countifyQuery($this->_query)
            )[0]["count(*)"];
    }

    public function countifyQuery($query)
    {
        $toks = explode(" ", $query);
        $res = array();
        $startToSelect = false;
        foreach ($toks as $x) {
            if ($startToSelect) {
                array_push($res, $x);
            }
            if (strtolower($x) == "from") {
                $startToSelect = true;
            }
        }
        return "select count(*) from " . implode(" ", $res);
    }

    public function toString()
    {
        return "hello";
    }
}
?>