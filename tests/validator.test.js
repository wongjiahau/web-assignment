const v = require('../src/jslibs/validator');

describe("isEmpty", () => {
    it("case 1", () => {
        expect(v("").isEmpty()).toBe(true);
    });

    it("case 2", () => {
        expect(v("hello").isEmpty()).toBe(false);
    });
});

describe("isInvalid.Title", () => {
    it("should return error if the length is more than 100", () => {
        let str = "";
        for (let i = 0; i < 100; i++) {
            str += "x";
        }
        expect(str).toHaveLength(100);
        expect(v(str).isInvalid.Title()).toEqual("Cannot contain more than 100 letters");
    });

    it("should return error if input contain weird symbols", () => {
        expect(v("asd]\~").isInvalid.Title()).toEqual("Cannot contain weird symbols");
    });

    it("should return empty string otherwise", () => {
        expect(v("Iron man 2").isInvalid.Title()).toBe("");
    });
    
});

describe("isInvalid.Year", () => {
    it("shold return false if the input is empty", () => {
        expect(v("").isInvalid.Year()).toBe("Cannot be empty");
    });
    it("should return false if input is greater than current year", () => {
        const currentYear = new Date().getFullYear();
        const laterYear = new Date().getFullYear() + 1;
        expect(laterYear).toBeGreaterThan(currentYear);
        expect(v(laterYear.toString()).isInvalid.Year()).toBe("Cannot be later than the current year");
    });

    it("should return false if the input is not 4 digit", () => {
        expect(v("123").isInvalid.Year()).toBe("Must consist of 4 digits only");
        expect(v("20133").isInvalid.Year()).toBe("Must consist of 4 digits only");
    });

    it("should return false if the year is less than 1878", () => {
        // According to https://headsup.boyslife.org/what-was-the-first-movie-ever-made/
        // The first ever made file is in 1878, so this should be the limit
        expect(v("1877").isInvalid.Year()).toBe("Cannot be earlier than 1878");
    });

    it("should return false if it contains non-digit char", () => {
        expect(v("18j8").isInvalid.Year()).toBe("Cannot contain non-digit letter");
    });

    it("should retun true otherwise", () => {
        expect(v("1899").isInvalid.Year()).toBe("");
        expect(v("1970").isInvalid.Year()).toBe("");
        expect(v("2014").isInvalid.Year()).toBe("");
    });
    
});

