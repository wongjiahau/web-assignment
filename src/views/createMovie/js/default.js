$(()=>{
    getYearOptions();
    getGenreOptions();
    $('#createMovieForm').submit(() => {
        return validateForm();
    });
});

function getYearOptions() {
    const FIRST_YEAR = 1878; // Refer this: https://headsup.boyslife.org/what-was-the-first-movie-ever-made/
    const currentYear = (new Date()).getFullYear();
    for (let i = currentYear; i >= FIRST_YEAR ; i--) {
        $('#yearSelect').append(`<option value=${i}>${i}</option>`)
        
    }
}

function getGenreOptions() {
    $.get('retrieveMovie/xhrGetGenre', (response) => {
        response.forEach(x => {
            $('#genreSelect').append(`<option value=${x}>${x}</option>`)
        });
    }, 'json');
}

function validateForm() {
    let gotError = false;
    function validate(name) {
        const errorMessage = v(document.getElementById(name + "Input").value).isInvalid[name]();
        document
            .getElementById(name + "Error")
            .innerHTML = errorMessage;
        if (errorMessage.length > 0) {
            gotError = true;
        }
    }
    validate("Title");
    validate("Year");
    validate("Genre");
    validate("Synopsis");
    return !gotError;
}