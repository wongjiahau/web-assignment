<?php
class CreateMovie extends Controller
{
    function __construct()
    {
        parent::__construct();
        $this->view->js = array(
            'createMovie/js/default.js',
        );
        $this->view->css = array(
            'createMovie/css/default.css'
        );
    }

    function index()
    {
        $this->view->render('createMovie/index');
    }

    function run()
    {
        $this->model->run(
            new Movie(
                $_POST['Title'],
                $_POST['Year'],
                $_POST['Genre'],
                $_POST['Image'],
                $_POST['Synopsis']
            )
        );
    }

}