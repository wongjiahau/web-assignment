<?php
class RetrieveMovieModel extends Model
{
    public function __construct()
    {
        parent::__construct();
        $this->PAGE_LIMIT = 10;
    }

    public function getSubQuery($searchWord, $selectedGenre = "", $selectedYear = "")
    {
        $query = "
        where title like '%$searchWord%'
        and genre like '%$selectedGenre%'
        and year like '%$selectedYear%'
        ";
        return $query;
    }

    public function getLimitQuery($pageNumber, $orderbyWhat)
    {
        $LIMIT = $this->PAGE_LIMIT;
        $startIndex = $pageNumber * $LIMIT;
        return " order by $orderbyWhat desc limit $startIndex, $LIMIT";
    }

    public function xhrGetMovie($searchWord, $selectedGenre = "", $selectedYear = "", $pageNumber = 0)
    {
        $subquery = $this->getSubQuery($searchWord, $selectedGenre, $selectedYear);
        $query = "select * from video " . $subquery;
        $query .= $this->getLimitQuery($pageNumber, "year");
        return json_encode($this->queryDb($query));
    }

    public function xhrGetNewMovie()
    {
        $subquery = $this->getSubQuery("", "", "");
        $query = 
            "select * from video " . $subquery .
            $this->getLimitQuery(0, "ts");
        return json_encode($this->queryDb($query));
    }


    public function xhrGetPageCount($searchWord, $selectedGenre = "", $selectedYear = "")
    {
        $subquery = $this->getSubQuery($searchWord, $selectedGenre, $selectedYear);
        $query = "select count(*) as count from video " . $subquery;
        $result = $this->queryDb($query);
        $count = ceil((int)($result[0]['count']) / $this->PAGE_LIMIT);
        return json_encode($count);
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