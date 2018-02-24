<?php
class RetrieveMovieModel extends Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function xhrGetMovie($searchWord, $selectedGenre = "", $selectedYear = "", $page = 0)
    {
        $LIMIT = 10;
        $startIndex = $page * $LIMIT;
        $query = <<<QUERY
        select * from video 
        where title like '%$searchWord%'
        and genre like '%$selectedGenre%'
        and year like '%$selectedYear%'
        limit $startIndex, $LIMIT
        ;
QUERY;
        return json_encode($this->queryDb($query));
    }

}