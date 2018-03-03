<?php
class DeleteMovie extends Controller
{
    function __construct()
    {
        parent::__construct();
    }

    function xhrRun()
    {
        Session::start();
        if (!isset($_SESSION["adminLoggedIn"])) {
            $this->accessForbidden();
        }
        echo $this->model->run($_GET['movie_id']);
    }
}