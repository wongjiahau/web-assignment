<?php
class RetrieveMovieModel extends Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function xhrGetMovie($searchWord, $selectedGenre = "", $selectedYear = "", $pageNumber = 0)
    {
        $LIMIT = 10;
        $startIndex = $pageNumber * $LIMIT;
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

    public function xhrGetGenre()
    {
        $query = 'select distinct genre from video;';
        $result = $this->queryDb($query);
        $genres = array();
        foreach ($result as $x) {
            $genres = array_merge($genres, array_map('trim', explode(',', $x['genre'])));
        }
        $genres = array_values(array_unique($genres));
        sort($genres);
        return json_encode($genres);
    }

    public function xhrGetYear()
    {
        $query = 'select distinct year from video order by year;';
        $result = $this->queryDb($query);
        $years = array();
        foreach ($result as $x) {
            array_push($years, $x['year']);
        }
        return json_encode($years);
    }

}