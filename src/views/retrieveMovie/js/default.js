var _currentPage = 0;
var _isAdminSession = false;
$(() => {
    $.get('retrieveMovie/xhrGetIsAdminSession', (response) => {
        _isAdminSession = JSON.parse(response);
        requestInitialMovies();
        requestGenres();
        requestYears();
    })
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
    if (_isAdminSession) {
        renderAdminUi();
    }
}

function renderAdminUi() {
    Ui.renderCreateMovieButton();
    Ui.injectCreateMovieHandler(() => window.location = ('createMovie'));
    Ui.injectUpdateMovieHandler(() => console.log("edit"), 
        (video_id) => () => {
            $.get('deleteMovie/xhrRun', {video_id})
            .done((response) => {
                const deleteSuccess = JSON.parse(response);
                if(deleteSuccess) {
                    Ui.markMovieAsDeleted(video_id);
                }
            });
    });
}

function requestInitialMovies() {
    $
        .get('retrieveMovie/xhrGetNewMovie', {})
        .done((response) => {
            const movies = JSON.parse(response);
            Ui.updateMovieList(movies, _isAdminSession);
            requestPageCount(getSearchParams(0));
            injectEventHandlers();
        });
}

function requestMovies(searchParams, updateHistory = true) {
    const onSuccess = (response) => {
        const movies = JSON.parse(response);
        Ui.clearMovieList();
        if (movies.length == 0) {
            Ui.reportNoMovieFound();
        } else {
            Ui.updateMovieList(movies, _isAdminSession);
            requestPageCount(searchParams);
            injectEventHandlers();
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
        Ui.injectGoToNextHandler(() => requestMovies(getSearchParams(_currentPage + 1)));
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