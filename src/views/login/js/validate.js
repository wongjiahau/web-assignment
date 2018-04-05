$(()=> {
    $('#_loginForm').submit(() => {
        return validateForm();
    });
});

function validateForm() {
    const userId = $('#_userid').val();
    const password = $('#_password').val();
    if(userId.length === 0) {
        alert("Please enter User Id.");
        return false;
    }

    if(password.length === 0) {
        alert("Please enter password.");
        return false;
    }
    return true;
}