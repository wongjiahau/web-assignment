<?php
class AdminController extends Controller
{
    function __construct()
    {
        parent::__construct();
    }

    private function checkIfUserIsAuthorized()
    {
        if (!Session::getAdmin()) {
            Navigator::goto('errorPage/_403');
            die();
        }
        $this->checkIfAdminSessionExipred();
    }

    private function checkIfAdminSessionExipred()
    {
        if (empty(Session::getAdminLastActivity())) {
            Session::resetAdminLastActivity();
            return;
        }
        $MAX_LIMIT_IN_SECONDS = 180;
        if ((time() - Session::getAdminLastActivity()) > $MAX_LIMIT_IN_SECONDS) {
            Session::endAdminSession();
            Navigator::goto('errorPage/_401');
            die;
        }
        Session::resetAdminLastActivity();
    }

    protected function index()
    {
        $this->checkIfUserIsAuthorized();
        $this->checkIfAdminSessionExipred();
    }

}