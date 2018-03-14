<?php

function getLabel($label, $renderer)
{
    echo "
    <div class='formInputDiv'>
        <span class='formLabel'>$label</span><br/>
        " . $renderer($label) . "<br/>
        <span class='errorMessage' id='${label}Error'></span><br/>
    </div>
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
    <label id='labelFor${label}Input' for='${label}Input'>
        <img id='selectedImage' class='movieImage' src='https://image.ibb.co/mGkDQx/notavail.jpg'>
    </label>
    <input type='file' name='$label' id='${label}Input'>
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
                <div id="centerPane">
                    <div id="leftPane">
                        <?php getLabel("Image", "imageInputRenderer"); ?>
                    </div>
                    <div id="rightPane">
                        <?php
                        getLabel("Title", "textInputRenderer");
                        getLabel("Genre", "multiSelectRenderer");
                        getLabel("Year", "selectRenderer");
                        getLabel("Synopsis", "textareaRenderer");
                        ?>
                    </div>
                </div>
        </div>
        <div id="bottomPane">
            <button class='clickable' onclick="history.back();">Cancel </button>
            <input class='primary clickable' type="submit" value="SUBMIT">
        </div>
    </form>
</body>