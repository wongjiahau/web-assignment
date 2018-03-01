<?php

function getLabel($label, $renderer)
{
    echo "
    <tr>
        <td id='formLabel'>$label</td> 
        <td>" . $renderer($label) . "</td>
        <td><span class='errorMessage' id='${label}Error'></span></td>
    </tr>
    ";
}

function textInputRenderer($label) {
    return "<input class='formInput' type='text' name='$label' id='${label}Input'>";
}

function selectRenderer($label) {
    return "<select class='formInput' name='$label' id='${label}Input'></select>";
}

function multiSelectRenderer($label) {
    return "<select class='formInput' name='$label' id='${label}Input' multiple></select>";
}

function textareaRenderer($label) {
    return "<textarea class='formInput' name='$label' id='${label}Input'></textarea>";
}

function imageInputRenderer($label) {
    return "<input type='file' name='$label' id='${label}Input'>";
}

?>
<head>
    <script src='<?php echo URL; ?>jslibs/validator.js'> </script>
</head>
<body>
    <form id="createMovieForm" method="post" enctype="multipart/form-data">
        <div id="createMovieDiv">
            <h1>Create new movie</h1>
            <table cellspacing="0" cellpadding="0">
                <tbody>
                    <?php
                    getLabel("Title", "textInputRenderer");
                    getLabel("Genre", "multiSelectRenderer");
                    getLabel("Year", "selectRenderer");
                    getLabel("Synopsis", "textareaRenderer");
                    getLabel("Image", "imageInputRenderer");
                    ?>
                </tbody>
            </table>
            <input type="submit" value="submit">
        </div>
    </form>
</body>