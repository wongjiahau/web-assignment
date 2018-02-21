<!doctype html>
<html>
<head>
    <title>Test</title>
    <link rel="stylesheet" href="<?php echo URL; ?>public/css/index.css">
    <script src="<?php echo URL; ?>public/js/jquery.js"></script>
</head>
<body>
<div id="header">
    header
    <br/>
    <a href="index">Index</a>
    <a href="help">help</a>
    <?php if(Session::get('loggedIn')): ?>
        <a href="dashboard/logout">Logout</a>
    <?php else: ?>
        <a href="login">Login</a>
    <?php endif; ?>
</div>

<div id="content">