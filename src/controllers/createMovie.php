<?php
class CreateMovie extends Controller
{
    function __construct()
    {
        parent::__construct();
        $this->view->js = array(
            'createMovie/js/default.js',
            'createMovie/js/injectFormAction.js',
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
        $x = new UploadedFileSaver($_FILES["Image"]);
        if ($x->uploadSuccess) {
            $img_path = $x->targetFile;
            $this->model->run(
                new Movie(
                    $_POST['Title'],
                    $_POST['Year'],
                    implode(", ", $_POST['Genre']),
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