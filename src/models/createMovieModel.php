<?php
class CreateMovieModel extends Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function run($movie) {
        $maxIndex = (int)$this->queryDb("select max(video_id) as x from video")[0]["x"];
        $maxIndex++;
        $sth = $this->db->prepare("
            insert into video(video_id, title, year, genre, img_path, synopsis) values(
                :video_id,
                :title,
                :year,
                :genre,
                :img_path,
                :synopsis
            )
        ");

        $sth->execute(array(
            ':video_id' => $maxIndex,
            ':title'    => $movie->title,
            ':year'     => $movie->year,
            ':genre'    => $movie->genre,
            ':img_path' => $movie->img_path,
            ':synopsis' => $movie->synopsis,
        ));

    }


}
