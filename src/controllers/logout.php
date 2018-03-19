<?php
class Logout extends Controller
{
    function __construct()
    {
        parent::__construct();
    }

    function index()
    {
        $this->view->render('logout/index');
    }

    function run()
    {
        Session::endAdminSession();
        Navigator::goto('login');
        exit;
    }
}
