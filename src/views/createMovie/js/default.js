$(() => {
    getYearOptions();
    getGenreOptions();
    injectImageInputHandler();
    $('#createMovieForm').submit(() => {
        return validateForm();
    });
});

function injectImageInputHandler() {
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#selectedImage').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    $("#ImageInput").change(function () { readURL(this); });
    // $("#selectedImage").load(() => $('#labelForImageInput').html("Change file"));
}

function getYearOptions() {
    const FIRST_YEAR = 1878; // Refer this: https://headsup.boyslife.org/what-was-the-first-movie-ever-made/
    const currentYear = (new Date()).getFullYear();
    for (let i = currentYear; i >= FIRST_YEAR; i--) {
        $('#YearInput').append(`<option value=${i}>${i}</option>`)
    }
}

function getGenreOptions() {
    $.get('retrieveMovie/xhrGetGenre', (response) => {
        console.log("rendering");
        response.forEach(x => {
            $('#GenreInput').append(`<option value=${x}>${x}</option>`)
        });

        // To avoid the need of holding Ctrl when selecting multiple value:
        // Refer https://stackoverflow.com/questions/8641729/how-to-avoid-the-need-for-ctrl-click-in-a-multi-select-box-using-javascript
        $('#GenreInput option').mousedown(function (e) {
            e.preventDefault();
            $(this).prop('selected', !$(this).prop('selected'));
            return false;
        });
    }, 'json');
}

function validateForm() {
    if(!validateFileType()) {
        alert("ERROR : You can only upload image!");
        return false;
    }

    function validate(type) {
        const errorMessage = v($(`#${type}Input`).val()).isInvalid[type]();
        $(`#${type}Error`).html(errorMessage);
        return errorMessage.length === 0;
    }

    const isValid = 
        validate("Title") && 
        validate("Year") && 
        validate("Genre") && 
        validate("Synopsis");
    return isValid;
}

function validateFileType() {
    const validFileExtensions = [".jpg", ".jpeg", ".bmp", ".gif", ".png"];    
    const filename = $('#ImageInput').val().toString();
    if (filename.length === 0) {
        return true;
    }
    return validFileExtensions.some((x) => filename.endsWith(x));
}