<?php
class CreateMovie extends Controller
{
    function __construct()
    {
        parent::__construct();
        $this->imgNotAvailableLink = "https://image.ibb.co/mGkDQx/notavail.jpg";
        $this->view->js = array(
            'createMovie/js/default.js',
            'createMovie/js/injectFormAction.js',
            'createMovie/js/injectTitle.js'
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
    }

    function run()
    {
        $x = new UploadedFileSaver($_FILES["Image"]);
        $img_path = isset($x->targetFile) ? $x->targetFile : $this->imgNotAvailableLink;
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
        StateManager::update($newState);
    }

}