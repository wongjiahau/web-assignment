function v(str) {
    return new Validator(str);
}
function Validator(str) {
    this.str = str;
    this.isEmpty = () => {
        return str.length === 0;
    }
    this.isInvalid = this.isEmpty()
        ? new NullValidatorChain("Cannot be empty")
        : new ValidatorChain(this.str);
}

function NullValidatorChain(errorMessage) {
    this.Title = () => errorMessage;
    this.Year = () => errorMessage;
    this.Year = () => errorMessage;
    this.Synopsis = () => errorMessage;
}

function ValidatorChain(str) {
    this.str = str;
    this.Title = () => {
        if(!/^[a-zA-Z0-9'"().,\?:\s]+$/.test(this.str)) {
            return "Cannot contain weird symbols";
        }
        if(this.str.length >= 100) {
            return "Cannot contain more than 100 letters";
        }
        return "";
    }

    this.Year = () => {

        if(!/[1,2][0, 8, 9][0-9]{2}/.test(this.str)) {
            return false;
        }
        const year = parseInt(this.str);
        if (year > new Date().getFullYear()) {
            return false;
        }
        if (year < 1878) {
            return false;
        }
        return true;
    }

}

function isValidTitle(str) {
    return !isEmpty(str);
}

function isValidYear(str) {

    return !isEmpty(str);
}

function isValidGenre(str) {
    return !isEmpty(str);
}

function isValidSynopsis(str) {
    return !isEmpty(str);
}

if (typeof module !== 'undefined') {
    module.exports = v;
}
