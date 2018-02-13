<?php
class QueryBuilder
{
    public $fromVideo;
    public function __construct()
    {
        $this->fromVideo = new VideoChainSelect("from video");
    }
}

function Q()
{
    return new QueryBuilder();
}

class VideoChainSelect
{
    private $_from;
    public $selectAll;
    public $selectCount;
    public function __construct($from)
    {
        $this->_from = $from;
        $this->selectAll = new VideoChainWhere('select * ' . $this->_from);
        $this->selectCount = new VideoChainWhere('select count(*) ' . $this->_from);
    }
}

class VideoChainWhere
{
    private $_prevQuery;
    public function __construct($prevQuery)
    {
        $this->_prevQuery = $prevQuery;
    }

    public function undelimited()
    {
        return $this->_prevQuery;
    }

    public function delimited()
    {
        return $this->_prevQuery . ';';
    }
}
?>

