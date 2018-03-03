<?php
class UpdateMovie extends Controller
{
    function __construct()
    {
        parent::__construct();
        $this->view->js = array(
            'createMovie/js/default.js',
            'updateMovie/js/retrieveData.js',
            'updateMovie/js/injectFormAction.js',
            'updateMovie/js/injectTitle.js'
        );
        $this->view->css = array(
            'createMovie/css/default.css'
        );
    }

    function index()
    {
        Session::start();
        if (!isset($_SESSION["adminLoggedIn"])) {
            $this->accessForbidden();
        }
        $this->view->render('createMovie/index');
        $this->view->injectGlobalConstants(array('CURRENT_movie_id' => $_GET['movie_id']));
    }

    function xhrGetMovie($movie_id)
    {
        echo $this->model->xhrGetMovie($movie_id);
    }

    function run()
    {
        $x = new UploadedFileSaver($_FILES["Image"]);
        $img_path = isset($x->targetFile) ? $x->targetFile : null;
        $this->model->run(
            $_GET['movie_id'],
            new Movie(
                $_POST['Title'],
                $_POST['Year'],
                implode(", ", $_POST['Genre']),
                $img_path,
                $_POST['Synopsis']
            )
        );
        $newState = array('url' => 'retrieveMovie');
        StateManager::update($newState);
    }

}