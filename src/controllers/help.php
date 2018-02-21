<?php
class Help extends Controller
{
    function __construct()
    {
        parent::__construct();
        echo "this is help";
    }

    function index()
    {
        $this->view->render('help/index');
    }

    function other($arg = false)
    {
        echo "oi";
        require 'models/helpModel.php';
        $model = new HelpModel();
        $this->view->blah = $model->blah();
    }
}