<?php
class Login extends Controller
{
    function __construct()
    {
        parent::__construct();
        $this->view->js = array(
            'login/js/validate.js',
        );
        $this->view->css = array(
            'login/css/default.css',
        );
    }

    function index()
    {
        if(Session::getAdmin()) {
            $this->stateManager->update(array('url' => 'src/retrieveMovie'));
        }
        $this->view->render('login/index');
    }

    function run()
    {
        $newState = $this->model->run($_POST['id'], $_POST['password']);
        echo($newState);
        $this->stateManager->update($newState);
    }
}
