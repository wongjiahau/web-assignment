<?php
class Dashboard extends Controller
{
    function __construct()
    {
        parent::__construct();
        if (!Session::get('adminLoggedIn')) {
            Session::destroy();
            Navigator::goto('login');
            exit;
        }
        $this->view->js = array('dashboard/js/default.js');
    }

    function index()
    {
        $this->view->render('dashboard/index');
    }

    function run()
    {
        $this->model->run();
    }

    function logout()
    {
        Session::destroy();
        Navigator::goto('login');
        exit;
    }

    function xhrInsert()
    {
        $this->model->xhrInsert();
    }

    function xhrGetListings()
    {
        $this->model->xhrGetListings();
    }

    function xhrDeleteListing()
    {
        $this->model->xhrDeleteListing();
    }
}
