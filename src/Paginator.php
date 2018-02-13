<?php
require_once($_SERVER['DOCUMENT_ROOT'] . "/src/DbLink.php");
class Paginator
{
    private $_dbLink;
    private $_queryBuilder;
    private $_page;
    private $_pageLimit;
    private $_result;
    private $_totalPages;

    public function __construct($dbLink, $queryBuilder, $page = 0, $pageLimit = 10)
    {
        $this->_dbLink = $dbLink;
        $this->_queryBuilder = $queryBuilder;
        $this->_page = $page;
        $this->_pageLimit = $pageLimit;
    }

    public function getPage()
    {
        $startIndex = $this->_page * $this->_pageLimit;
        $limit = $this->_pageLimit;
        $limitedQuery = $this->_queryBuilder->undelimited() . " limit $startIndex, $limit;";
        return $this->_dbLink->sendQuery($limitedQuery);
    }

    public function getTotalCount()
    {
        return (int)$this->_dbLink
            ->sendQuery(
                $this->countifyQuery($this->_queryBuilder->delimited())
            )[0]["count(*)"];
    }

    public function getTotalPageCount()
    {
        return (int)ceil($this->getTotalCount() / $this->_pageLimit);
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

    public function getGlue()
    {
        $result = array(
            "currentPage" => $this->_page,
            "totalPageCount" => $this->getTotalPageCount(),
            "pageData" => $this->getPage($this->_page)
        );
        return $result;
    }
}
?>