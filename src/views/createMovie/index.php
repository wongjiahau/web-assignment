<?php

function getLabel($label, $renderer)
{
    echo "
    <tr>
        <td><span id='formLabel'>$label</span></td> 
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
    return "<select class='formInput' name='${label}[]' id='${label}Input' multiple></select>";
}

function textareaRenderer($label) {
    return "<textarea class='formInput' name='$label' id='${label}Input'></textarea>";
}

function imageInputRenderer($label) {
    //How to style file input? => https://tympanus.net/codrops/2015/09/15/styling-customizing-file-inputs-smart-way/
    return "
    <img id='selectedImage' class='movieImage' src='https://image.ibb.co/mGkDQx/notavail.jpg'>
    <br/>
    <input type='file' name='$label' id='${label}Input'>
    <label id='labelFor${label}Input' for='${label}Input' class='clickable openFile'>Choose file</label>
            ";
}

?>
<head>
    <script src='<?php echo URL; ?>jslibs/validator.js'> </script>
</head>
<body>
    <form id="createMovieForm" method="post" enctype="multipart/form-data">
        <div id="createMovieDiv">
            <h1 id='pageTitle'></h1>
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
            <br/>
            <button class='clickable' onclick="history.back();">Cancel </button>
            <input class='primary clickable' type="submit" value="SUBMIT">
        </div>
    </form>
</body>