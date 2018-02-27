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
        $x = new UploadedFileSaver("Image");
        $img_path = $x->targetFile;
        $this->model->run(
            new Movie(
                $_POST['Title'],
                $_POST['Year'],
                $_POST['Genre'],
                $img_path,
                $_POST['Synopsis']
            )
        );
    }

}