function v(str) {
    return new Validator(str);
}
function Validator(str) {
    this.str = str;
    this.isEmpty = () => {
        return str === null || str.length === 0;
    }
    this.isInvalid = this.isEmpty()
        ? new NullValidatorChain("Cannot be empty")
        : new ValidatorChain(this.str);
}

function NullValidatorChain(errorMessage) {
    this.Title = () => errorMessage;
    this.Year = () => errorMessage;
    this.Genre = () => errorMessage;
    this.Synopsis = () => errorMessage;
    this.Image = () => errorMessage;
}

function ValidatorChain(str) {
    this.str = str;
    this.Title = () => {
        if(!/^[a-zA-Z0-9'"().,\?:\-\s]+$/.test(this.str)) {
            return "Cannot contain weird symbols";
        }
        if(this.str.length >= 1000) {
            return "Cannot contain more than 100 letters";
        }
        return "";
    }

    this.Year = () => {

        if(!/^[0-9]+$/.test(this.str)) {
            return "Cannot contain non-digit letter";
        }
        if(this.str.length !== 4) {
            return "Must consist of 4 digits only";
        }
        const year = parseInt(this.str);
        if (year > new Date().getFullYear()) {
            return "Cannot be later than the current year";
        }
        if (year < 1878) {
            return "Cannot be earlier than 1878";
        }
        return "";
    }

    this.Genre = () => {
        return this.Title();
    }

    this.Synopsis = () => {
        return this.Title();
    } 

    this.Image = () => {
        return "";
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
