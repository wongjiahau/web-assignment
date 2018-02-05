<?php
function big_button($content, $url)
{
    echo "<a href='$url'>$content</a><br/>";
}
?>
<html>
    <body>
        <h1>Welcome to Admin Home</h1>
        <?php big_button("Add new movies", "404") ?>
        <?php big_button("Delete movies", "404") ?>
        <?php big_button("Edit movies", "404") ?>
        <?php big_button("Browse movies", "404") ?>
    </body>
</html>