<?php

echo exec('whoami');
function getLabel($label)
{
    echo "
    <tr>
        <td id='formLabel'>$label</td>
        <td><input class='formInput' type='text' name='$label' id='${label}Input'></td>
        <td><span class='errorMessage' id='${label}Error'></span></td>
    </tr>
    ";
}

?>
<html>
    <head>
        <script src='<?php echo URL; ?>jslibs/validator.js'> </script>
    </head>
    <body>
        <form id="createMovieForm" action="createMovie/run" method="post" enctype="multipart/form-data">
            <div id="createMovieDiv">
                <h1>Create new movie</h1>
                <table cellspacing="0" cellpadding="0">
                    <tbody>
                        <?php
                        getLabel("Title");
                        ?>
                        <tr>
                            <td id="formLabel"> Genre </td>
                            <td> <select name="Genre" id="genreSelect" class="clickable formInput"></select> </td>
                        </tr>
                        <tr>
                            <td id="formLabel"> Year </td>
                            <td> <select name="Year" id="yearSelect" class="clickable formInput"></select> </td>
                        </tr>
                        <tr>
                            <td id="formLabel"> Synopsis </td>
                            <td> <textarea name="Synopsis" class="formInput"></textarea> </td>
                        </tr>
                    </tbody>
                </table>
                Image: <input type="file" name="Image" id="imageInput"><br>
                <input type="submit" value="submit">
            </div>
        </form>
        
    </body>
</html>