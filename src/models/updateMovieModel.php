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

}