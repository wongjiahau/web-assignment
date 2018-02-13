<?php
require_once($_SERVER['DOCUMENT_ROOT'] . "/src/DbLink.php");
class Paginator
{
    private $_dbLink;
    private $_queryBuilder;
    private $_result;
    private $_totalPages;

    public function __construct($dbLink, $queryBuilder)
    {
        $this->_dbLink = $dbLink;
        $this->_queryBuilder = $queryBuilder;
    }

    public function getPage($page = 0, $limit = 10)
    {
        $startIndex = $page * $limit;
        $limitedQuery = $this->_queryBuilder->undelimited() . " limit $startIndex, $limit;";
        return $this->_dbLink->sendQuery($limitedQuery);
    }

    public function getTotalCount()
    {
        return (int)$this->_dbLink
            ->sendQuery(
                $this->countifyQuery($this->_queryBuilder)
            )[0]["count(*)"];
    }

    public function countifyQuery($queryBuilder)
    {
        $toks = explode(" ", $queryBuilder);
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