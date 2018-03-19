<?php
class Session
{
    private static function start()
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
    }
    private static function set($key, $value = true)
    {
        Session::start();
        $_SESSION[$key] = $value;
    }

    private static function get($key)
    {
        Session::start();
        if (isset($_SESSION[$key])) {
            return $_SESSION[$key];
        } else {
            return false;
        }
    }

    private static function unset($key)
    {
        Session::start();
        unset($_SESSION[$key]);
    }

    private static function destroy()
    {
        session_destroy();
    }

    public static function getAdmin()
    {
        return Session::get('admin');
    }

    public static function setAdmin($value)
    {
        Session::set('admin', $value);
    }

    public static function endAdminSession()
    {
        Session::unset('admin');
    }

    public static function resetAdminLastActivity()
    {
        Session::set('adminLastActivity', time());
    }

    public static function getAdminLastActivity()
    {
        return Session::get('adminLastActivity');
    }
}
