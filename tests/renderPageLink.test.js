const x = require('../src/views/retrieveMovie/js/renderPageLinks');

describe('getPageLinkTemplate', () => {
    it('case 1', () => {
        expect(x.getPageLinkTemplate(0, 2, 10)).toBe('[1]|2|>');
    });

    it('case 2', () => {
        expect(x.getPageLinkTemplate(1, 11, 10)).toBe('<|1|[2]|3|4|5|6|7|8|9|10|>');
    });

    it('case 3', () => {
        expect(x.getPageLinkTemplate(10, 11, 10)).toBe('<|[11]');
    });

    it('case 4', () => {
        expect(x.getPageLinkTemplate(13, 30, 10)).toBe('<|11|12|13|[14]|15|16|17|18|19|20|>');
    });

});

describe('splitNumber', () => {
    it('case 1', () => {
        expect(x.splitNumber(11, 10)).toEqual([10, 1]);
    });

    it('case 2', () => {
        expect(x.splitNumber(25, 10)).toEqual([10, 10, 5]);
    });
});