$(() => {
    getYearOptions();
    getGenreOptions();
    $('#createMovieForm').submit(() => {
        return validateForm();
    });
});

function getYearOptions() {
    const FIRST_YEAR = 1878; // Refer this: https://headsup.boyslife.org/what-was-the-first-movie-ever-made/
    const currentYear = (new Date()).getFullYear();
    for (let i = currentYear; i >= FIRST_YEAR; i--) {
        $('#YearInput').append(`<option value=${i}>${i}</option>`)

    }
}

function getGenreOptions() {
    $.get('retrieveMovie/xhrGetGenre', (response) => {
        response.forEach(x => {
            $('#GenreInput').append(`<option value=${x}>${x}</option>`)
        });
    }, 'json');
}

function validateForm() {
    function validate(type) {
        const errorMessage = v($(`#${type}Input`).val()).isInvalid[type]();
        $(`#${type}Error`).html(errorMessage);
        return errorMessage.length === 0;
    }

    const isValid = 
        validate("Title") && 
        validate("Year") && 
        validate("Genre") && 
        validate("Synopsis") &&
        validate("Image")
    return isValid;
}