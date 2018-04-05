<div class='outerDiv'>
    <div class='innerDiv'>
        <h3>Login to AAA Movie Library</h3>
        <form id="_loginForm" class="loginForm" action="login/run" method="post">
            <input id="_userid" type="text" name="id" placeholder="User ID"/> <br>
            <input id="_password" type="password" name="password" placeholder="Password"/> <br>
            <?php if(isset($_GET['error'])): ?>
                <span class="error">ERROR: Invalid ID or password.</span> <br/>
            <?php endif; ?>
            <input class='primary clickable submit' type="submit" value="LOGIN">
        </form>
    </div>
</div>