const v = require('../home/admin/validator');

describe("isEmpty", () => {
    it("case 1", () => {
        expect(v("").isEmpty()).toBe(true);
    });

    it("case 2", () => {
        expect(v("hello").isEmpty()).toBe(false);
    });
});

describe("isValid.Year", () => {
    it("shold return false if the input is empty", () => {
        expect(v("").isValid.Year()).toBe(false);
    });
    it("should return false if input is greater than current year", () => {
        const currentYear = new Date().getFullYear();
        const laterYear = new Date().getFullYear() + 1;
        expect(laterYear).toBeGreaterThan(currentYear);
        expect(v(laterYear.toString()).isValid.Year()).toBe(false);
    });

    it("should return false if the input is not 4 digit", () => {
        expect(v("123").isValid.Year()).toBe(false);
        expect(v("20133").isValid.Year()).toBe(false);
    });

    it("should return false if the year is less than 1878", () => {
        // According to https://headsup.boyslife.org/what-was-the-first-movie-ever-made/
        // The first ever made file is in 1878, so this should be the limit
        expect(v("1877").isValid.Year()).toBe(false);
    });

    it("should return false if it contains non-digit char", () => {
        expect(v("18j8").isValid.Year()).toBe(false);
    });

    it("should retun true otherwise", () => {
        expect(v("1899").isValid.Year()).toBe(true);
        expect(v("1970").isValid.Year()).toBe(true);
        expect(v("2014").isValid.Year()).toBe(true);
    });
    
});

