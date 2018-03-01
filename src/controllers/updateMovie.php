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
        if ($x->uploadSuccess) {
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
            $newState = array('url' => 'retrieveMovie');
        } else {
            $newState = array('url' => 'createMovie');
        }
        StateManager::update($newState);
    }

}