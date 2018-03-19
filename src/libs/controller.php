<?php

class Controller
{
    function __construct()
    {
        $this->view = new View();
        $this->stateManager = new StateManager();
        // $this->checkIfAdminSessionExipred();
    }


    public function loadModel($name)
    {
        $path = 'models/' . $name . 'Model.php';
        if (file_exists($path)) {
            require_once $path;
            $modelName = $name . 'Model';
            $this->model = new $modelName;
        }
    }

}