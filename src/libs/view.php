<?php
class View
{
    function __construct()
    {

    }

    public function render($name, $includeHeaderAndFooter = true)
    {
        if ($includeHeaderAndFooter) {
            require 'views/header.php';
            require 'views/' . $name . '.php';
            require 'views/footer.php';
        } else {
            require 'views/' . $name . '.php';
        }
    }

    public function injectGlobalConstants($map) {
        foreach ($map as $key => $value) {
            echo "<script lang='js'> const $key = $value; </script>";
        }
    }
}