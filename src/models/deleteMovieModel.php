<?php
class DeleteMovieModel extends Model
{
    function __construct()
    {
        parent::__construct();
    }

    function run($video_id)
    {
        $sth = $this->db->prepare("delete from video where video_id = :video_id");
        $sth->execute(array(":video_id" => $video_id));
        // rowCount() means to get affected rows
        // if affected rows is zero means the delete is failed
        return $sth->rowCount() > 0;
    }
}