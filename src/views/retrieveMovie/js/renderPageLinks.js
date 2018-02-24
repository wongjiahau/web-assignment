const PAGE_LINK_LIMIT = 10;
function renderPageLinks(pageCount, currentPage) {
    if (pageCount == 1) {
        return "";
    }
    var result = "";
    const template = getPageLinkTemplate(currentPage, pageCount, PAGE_LINK_LIMIT);
    template
        .split('|')
        .forEach(t => {
            switch (t) {
                case '<':
                    result += `<button id="prevBtn">Previous</button>`;
                    break;
                case '>':
                    result += `<button id="nextBtn">Next</button>`;
                    break;
                default:
                    result += singlePageLink(t);
                    break;
            }
        });
    return result;
}

function singlePageLink(pageNumber) {
    const id = `pglink${pageNumber}`;
    const result = `<button id="${id}">${pageNumber}</button>`
    return result;
}

/**
 *
 *
 * @param {any} currentPage : Zero-based index
 * @param {any} pageCount
 * @param {any} [pagePerSection=PAGE_LINK_LIMIT]
 * @returns
 */
function getPageLinkTemplate(currentPage, pageCount, pagePerSection) {
    const currentSection = Math.floor(currentPage / pagePerSection);
    const offset = currentSection * pagePerSection;
    var result = "";
    for (let i = 0; i < pageCount && i < splitNumber(pageCount, pagePerSection)[currentSection]; i++) {
        const current = i + offset;
        if (current === currentPage) {
            result += `[${current + 1}]|`;
            continue;
        }
        result += `${current + 1}|`;
    }
    if (pageCount > pagePerSection) {
        const lastSection = Math.ceil(pageCount / pagePerSection);
        if (currentSection < lastSection - 1) {
            result += ">";
        }
        if (currentSection > 0) {
            result = "<|" + result;
        }
    }
    return result.replace(/\|+$/, '');
}

function splitNumber(number, splitValue) {
    const res = [];
    const splitted = number / splitValue;
    for (let i = 0; i < Math.floor(splitted); i++) {
        res.push(splitValue);
    }
    res.push(Math.floor((splitted % 1) * splitValue));
    return res;
}

if (typeof module !== 'undefined') {
    module.exports = {
        getPageLinkTemplate,
        splitNumber
    };
}
