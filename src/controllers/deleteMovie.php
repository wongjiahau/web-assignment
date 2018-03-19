<?php
class DeleteMovie extends AdminController
{
    function __construct()
    {
        parent::__construct();
    }

    function xhrRun()
    {
        parent::checkIfUserIsAuthorized();
        echo $this->model->run($_GET['movie_id']);
    }
}