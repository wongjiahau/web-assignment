function v(str) {
    return new Validator(str);
}
function Validator(str) {
    this.str = str;
    this.isEmpty = () => {
        return str.length === 0;
    }
    this.isValid = this.isEmpty()
        ? new NullValidatorChain()
        : new ValidatorChain(this.str);
}

function NullValidatorChain() {
    this.Title = () => false
    this.Year = () => false
    this.Year = () => false
    this.Synopsis = () => false
}

function ValidatorChain(str) {
    this.str = str;
    this.Title = () => {}

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
