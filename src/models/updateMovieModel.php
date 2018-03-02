<?php
class UpdateMovieModel extends Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function xhrGetMovie($movie_id)
    {
        $res = $this->queryDb(
            "select * from movie where movie_id = :movie_id",
            array(':movie_id' => $movie_id)
        );
        return json_encode($res[0]);
    }

    public function run($movie_id, $movie)
    {
        $this->queryDb(
            "update movie 
            set title = :title,
                year = :year,
                genre = :genre,
                synopsis = :synopsis,
                img_path = COALESCE( :img_path, img_path)
                where movie_id = :movie_id",
            array(
                ":title" => $movie->title,
                ":year" => $movie->year,
                ":genre" => $movie->genre,
                ":synopsis" => $movie->synopsis,
                ":img_path" => $movie->img_path,
                ":movie_id" => (int)$movie_id
            )
        );
    }


}