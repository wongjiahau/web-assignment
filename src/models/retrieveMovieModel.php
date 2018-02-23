<?php
class RetrieveMovieModel extends Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function xhrGetMovie($searchWord)
    {
        $query = <<<QUERY
        select * from video 
        where title like '%$searchWord%'
        ;
QUERY;
        return json_encode($this->queryDb($query));
    }

}