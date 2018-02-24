<?php
class RetrieveMovie extends Controller
{
    function __construct()
    {
        parent::__construct();
        $this->view->js = array(
            'retrieveMovie/js/default.js', 
            'retrieveMovie/js/renderMovieItem.js'
        );
    }

    function index()
    {
        $this->view->render('retrieveMovie/index');
    }

    function xhrGetMovie()
    {
        echo $this->model->xhrGetMovie("");
    }
}