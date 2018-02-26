var _currentPage = 0;
$(() => {
    requestMovies(getSearchParams(0));
    requestGenres();
    requestYears();
    injectEventHandlers();
});

function requestGenres() {
    $.get('retrieveMovie/xhrGetGenre', (response) => {
        Ui.updateGenreOptions(response);
    }, 'json');
}

function requestYears() {
    $.get('retrieveMovie/xhrGetYear', (response) => {
        Ui.updateYearOptions(response);
    }, 'json');
}

function injectEventHandlers() {
    Ui.injectSearchHandler(() => requestMovies(getSearchParams(0)));
    Ui.injectGoBackHandler((params) => () => {
        requestMovies(params, false);
        setSearchParams(params);
    });
}

function requestMovies(searchParams, updateHistory = true) {
    const onSuccess = (response) => {
        const movies = JSON.parse(response);
        Ui.clearMovieList();
        if (movies.length == 0) {
            Ui.reportNoMovieFound();
        } else {
            Ui.updateMovieList(movies);
            requestPageCount(searchParams);
        }
    }
    $
        .get('retrieveMovie/xhrGetMovie', searchParams)
        .done(onSuccess);
    _currentPage = searchParams.pageNumber;
    if (updateHistory) {
        history.pushState(searchParams, null, null);
    }
}

function requestPageCount(searchParams) {
    const onSuccess = (response) => {
        const pageCount = response;
        Ui.updatePageLinks(pageCount, _currentPage);
        Ui.injectNavigationHandler(pageCount, (i) => () => requestMovies(getSearchParams(i)));
        Ui.injectGoToPrevHandler(() => requestMovies(getSearchParams(_currentPage - 1)));
        Ui.injecetGoToNextHandler(() => requestMovies(getSearchParams(_currentPage + 1)));
    }
    $
        .get('retrieveMovie/xhrGetPageCount', searchParams)
        .done(onSuccess);

}

function getSearchParams(pageNumber) {
    return {
        searchWord: $('#searchInput').val(),
        selectedGenre: $('#genreSelect').val(),
        selectedYear: $('#yearSelect').val(),
        pageNumber: pageNumber
    };
}

function setSearchParams(params) {
    $('#searchInput').val(params.searchWord);
    $('#genreSelect').val(params.selectedGenre);
    $('#yearSelect').val(params.selectedYear);
}