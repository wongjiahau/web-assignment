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
    <a class="websiteTitle" href="retrieveMovie"><span class="websiteTitle">AAA Movie Library</span></a>
    <span class="userPanel">
        <?php if (Session::get('adminLoggedIn')) : ?>
            <button class='clickable' onclick='window.location="dashboard/logout"'>Logout</button>
        <?php else : ?>
            <button class='clickable' onclick='window.location="login"'>Login</button>
        <?php endif; ?>
    </span>
</div>

<div id="content">