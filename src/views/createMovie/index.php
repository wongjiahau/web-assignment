<?php
function generateInput($name) {
    echo "<input placeholder='$name' type='text' name='$name' id='${name}Input'> ";
    echo "<div class='errorMessage' id='${name}Error'></div>";
}

error_reporting(E_ALL);
ini_set('display_errors', 1);
if (isset($_POST['Title'])) {
    echo $_POST['Title'];
    return;
}
?>
<html>
    <head>
        <style>
            .errorMessage {
                color:red
            }
        </style>
        <script src='<?php echo URL;?>jslibs/validator.js'> </script>
    </head>
    <body>
        <div id="createMovieDiv">
            <h1>Create new movie</h1>
            <form id="createMovieForm" action="createMovie/run" method="post">
                <?php
                generateInput("Title");
                generateInput("Year");
                generateInput("Genre");
                generateInput("Synopsis");
                ?>
                Image: <input type="text" name="Image" id="imageInput"><br>
                <input type="submit" value="submit">
            </form>
        </div>
        
    </body>
</html>