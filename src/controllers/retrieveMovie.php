<?php
class RetrieveMovie extends Controller
{
    function __construct()
    {
        parent::__construct();
        $this->view->js = array(
            'retrieveMovie/js/default.js',
            'retrieveMovie/js/renderMovieItem.js',
            'retrieveMovie/js/renderPageLinks.js'
        );
        $this->view->css = array(
            'retrieveMovie/css/default.css'
        );
    }

    function index()
    {
        $this->view->render('retrieveMovie/index');
    }

    function xhrGetMovie()
    {
        echo $this->model->xhrGetMovie(
            $_GET['searchWord'],
            $_GET['selectedGenre'],
            $_GET['selectedYear'],
            (int)$_GET['pageNumber']
        );
    }

    function xhrGetGenre() 
    {
        echo $this->model->xhrGetGenre();
    }

    function xhrGetYear() 
    {
        echo $this->model->xhrGetYear();
    }

    function xhrGetPageCount()
    {
        echo $this->model->xhrGetPageCount(
            $_GET['searchWord'],
            $_GET['selectedGenre'],
            $_GET['selectedYear'],
            (int)$_GET['pageNumber']
        );
    }

}