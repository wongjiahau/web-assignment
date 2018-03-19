<?php
class ErrorPage extends Controller
{
    function __construct($errorMsg = "")
    {
        parent::__construct();
        $this->view->css = array(
            'errorPage/css/default.css',
        );
    }

    function index()
    {
        $this->_404();
    }

    function _404()
    {
        $this->view->render('errorPage/404');
    }

    function _403()
    {
        $this->view->render('errorPage/403');
    }

    function _401()
    {
        $this->view->render('errorPage/401');
    }

}
