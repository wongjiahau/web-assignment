<?php
// Fof stands for Four-Oh-Four, which means 404, which means Error
// We cannot define our own Error class because it is a built in class in php7.0++
class Fof extends Controller
{
    function __construct($errorMsg = "")
    {
        parent::__construct();
        $this->view->css = array(
            'fof/css/default.css',
        );
        $this->view->render('fof/index');
    }
    
}
