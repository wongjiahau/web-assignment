<?php
class Index extends Controller
{
    function __construct()
    {
        parent::__construct();
        header("location: retrieveMovie");
    }

    function index()
    {
        $this->view->render('index/index');
    }
}