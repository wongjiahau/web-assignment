<?php
class AdminController extends Controller
{
    function __construct()
    {
        parent::__construct();
    }

    function checkIfUserIsAuthorized()
    {
        if (!Session::getAdmin()) {
            $this->accessForbidden();
        }
    }

    // function checkIfAdminSessionExipred() {
    //     Session::start();
    //     if (isset($_SESSION["adminLoggedIn"])) {
    //         $MAX_LIMIT = 15 * 60; // 15 minutes
    //         if (isset($_SESSION['LAST_ACTIVITY'])) {
    //             if (time() - $_SESSION['LAST_ACTIVITY'] > $MAX_LIMIT) {
    //                 Session::destroy();
    //             }
    //         } else {
    //             $_SESSION['LAST_ACTIVITY'] = time();
    //         }
    //         echo $_SESSION["LAST_ACTIVITY"];
    //     }
    // }
}