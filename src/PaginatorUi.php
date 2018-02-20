<?php 
class PaginatorUi
{
    private $_totalPageCount;
    private $_currentPage;
    private $_clickHandlerName;

    public function __construct($totalPageCount, $currentPage, $clickHandlerName)
    {
        $this->_totalPageCount = $totalPageCount;
        $this->_currentPage = $currentPage;
        $this->_clickHandlerName = $clickHandlerName;
    }

    public function renderPageLink($pageNumber)
    {
        $handler = $this->_clickHandlerName;
        return trim("
        <a onclick='${handler}($pageNumber);' href=''>$pageNumber</a>
        ");
    }

    public function render()
    {
        $html = "";
        // TODO: If totalPageCount more than 10, the rendering algo should be different
        for($i = 0; $i < 10; $i++) {
            $html .= $this->renderPageLink($i);
        }
        return $html;

    }
}
?>