<?php
class CreateMovieModel extends Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function run($movie) {
        $maxIndex = (int)$this->queryDb("select max(movie_id) as x from movie")[0]["x"];
        $maxIndex++;
        $sth = $this->db->prepare("
            insert into movie(movie_id, title, year, genre, img_path, synopsis) values(
                :movie_id,
                :title,
                :year,
                :genre,
                :img_path,
                :synopsis
            )
        ");

        $sth->execute(array(
            ':movie_id' => $maxIndex,
            ':title'    => $movie->title,
            ':year'     => $movie->year,
            ':genre'    => $movie->genre,
            ':img_path' => $movie->img_path,
            ':synopsis' => $movie->synopsis,
        ));

    }


}
