<?php
function generateInput($name) {
    echo "$name: <input type='text' name='$name' id='${name}Input'> ";
    echo "<div id='${name}Error'></div>";
}

error_reporting(E_ALL);
ini_set('display_errors', 1);
if (isset($_POST['title'])) {
    echo $_POST['title'];
}
?>
<html>
    <head>
        <script src="./validator.js">
        </script>
        <script>
            function validateForm() {
                let gotError = false;
                function validate(name) {
                    const errorMessage = 
                        v(document.getElementById(name + "Input").value).isInvalid[name]();
                    document.getElementById(name + "Error").innerHTML = errorMessage;
                    if(errorMessage.length > 0) {
                        gotError = true;
                    }
                }
                validate("Title");
                validate("Year");
                validate("Genre");
                validate("Synopsis");
                return !gotError;
            }
        </script>
    </head>
    <body>
        <h1>Create new movie</h1>
        <form action="create_movie.php" onsubmit="return validateForm()" method="post">
            <?php
            generateInput("Title");
            generateInput("Year");
            generateInput("Genre");
            generateInput("Synopsis");
            ?>
            Image: <input type="text" name="image" id="imageInput"><br>
            <input type="submit" value="submit">
        </form>
        
    </body>
</html>