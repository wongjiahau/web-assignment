<?php
class Dashboard extends Controller
{
    function __construct()
    {
        parent::__construct();
        if (!Session::get('loggedIn')) {
            Session::destroy();
            Navigator::goto('login');
            exit;
        }
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
}
