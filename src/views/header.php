<!doctype html>
<html>
<head>
    <title>Test</title>
    <link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Open+Sans">
    <link rel="stylesheet" href="<?php echo URL; ?>public/css/index.css">
    <script src="<?php echo URL; ?>public/js/jquery.js"></script>
    <?php
    $url = URL;
    if (isset($this->js)) {
        foreach ($this->js as $js) {
            echo "<script src='{$url}views/$js'></script>";
        }
    }
    if(isset($this->css)) {
        foreach ($this->css as $css) {
            echo "<link rel='stylesheet' href='{$url}views/$css'>";
        }
    }
    ?>
</head>
<body>
<div id="header">
    <span id="title">AAA Movie Library</span>
    <br/>
    <a href="index">Index</a>
    <a href="help">help</a>
    <?php if (Session::get('adminLoggedIn')) : ?>
        <a href="dashboard/logout">Logout</a>
    <?php else : ?>
        <a href="login">Login</a>
    <?php endif; ?>
</div>

<div id="content">