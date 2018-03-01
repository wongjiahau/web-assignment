<?php
class UpdateMovieModel extends Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function xhrGetMovie($video_id)
    {
        $res = $this->queryDb(
            "select * from video where video_id = :video_id",
            array(':video_id' => $video_id)
        );
        return json_encode($res[0]);
    }

    public function run($video_id, $movie)
    {
        $this->queryDb(
            "update video 
            set title = :title,
                year = :year,
                genre = :genre,
                synopsis = :synopsis,
                img_path = COALESCE( :img_path, img_path)
                where video_id = :video_id",
            array(
                ":title" => $movie->title,
                ":year" => $movie->year,
                ":genre" => $movie->genre,
                ":synopsis" => $movie->synopsis,
                ":img_path" => $movie->img_path,
                ":video_id" => (int)$video_id
            )
        );
    }


}