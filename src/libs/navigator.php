<?php
class Navigator
{
    public static function goto($location)
    {
        header("location: " . URL . "$location");
    }
}