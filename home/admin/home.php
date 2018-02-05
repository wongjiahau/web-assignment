<?php
function big_button($content, $url)
{
    echo "<a href='$url'>$content</a><br/>";
}
?>
<html>
    <body>
        <h1>Welcome to Admin Home</h1>
        <?php big_button("Add new movies", "create_movie.php") ?>
        <?php big_button("Delete movies", "delete_movie.php") ?>
        <?php big_button("Edit movies", "update_movie.php") ?>
        <?php big_button("Browse movies", "retrieve_movie.php") ?>
    </body>
</html>