<?php
class Session
{
    public static function start()
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
    }
    public static function set($key, $value = true)
    {
        Session::start();
        $_SESSION[$key] = $value;
    }

    public static function get($key)
    {
        Session::start();
        if (isset($_SESSION[$key])) {
            return $_SESSION[$key];
        } else {
            return false;
        }
    }

    public static function destroy()
    {
        session_destroy();
    }

}
