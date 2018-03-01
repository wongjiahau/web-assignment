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
        );
        $this->view->css = array(
            'createMovie/css/default.css'
        );
    }

    function index()
    {
        $this->view->render('createMovie/index');
        $this->view->injectGlobalConstants(array('CURRENT_VIDEO_ID' => $_GET['video_id']));
    }

    function xhrGetMovie($video_id)
    {
        echo $this->model->xhrGetMovie($video_id);
    }

    function run()
    {
        $x = new UploadedFileSaver($_FILES["Image"]);
        $img_path = isset($x->targetFile) ? $x->targetFile : null;
        $this->model->run(
            $_GET['video_id'],
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