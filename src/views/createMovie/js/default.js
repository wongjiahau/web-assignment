$(()=>{
    $('#createMovieForm').submit(() => {
        return validateForm();
    });
});

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