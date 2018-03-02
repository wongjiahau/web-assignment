<?php
class DeleteMovieModel extends Model
{
    function __construct()
    {
        parent::__construct();
    }

    function run($movie_id)
    {
        $sth = $this->db->prepare("delete from movie where movie_id = :movie_id");
        $sth->execute(array(":movie_id" => $movie_id));
        // rowCount() means to get affected rows
        // if affected rows is zero means the delete is failed
        return $sth->rowCount() > 0;
    }
}