<?php
class DeleteMovie extends Controller
{
    function __construct()
    {
        parent::__construct();
    }

    function xhrRun()
    {
        echo $this->model->run($_GET['movie_id']);
    }
}