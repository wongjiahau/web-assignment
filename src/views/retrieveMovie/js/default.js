var _currentPage = 0;
var _ui;
var _handlerInjector;
$(() => {
    $.get('retrieveMovie/xhrGetIsAdminSession', (response) => {
        const isAdminSession = JSON.parse(response);
        _ui = new Ui(isAdminSession);
        _handlerInjector = constructHandlerInjector(isAdminSession);
        _handlerInjector.init();
        requestGenres();
        requestYears();
        requestInitialMovies();
        requestPageCount(getSearchParams(0));
    })
});

function constructHandlerInjector(isAdmin) {
    return new HandlerInjector(isAdmin, {
        searchMovieCallback:        ()  => requestMovies(getSearchParams(0)),
        navigateDoubleCallback:     (i) => () => requestMovies(getSearchParams(i)),
        goToNextCallback:           ()  => requestMovies(getSearchParams(_currentPage + 1)),
        goToPrevCallback:           ()  => requestMovies(getSearchParams(_currentPage - 1)),
        goBackdoubleCallback:       (params) => () => {
                requestMovies(params, false);
                setSearchParams(params);
            },
        createMovieCallback:        () => window.location = 'createMovie',
        updateMovieDoubleCallback:  (movie_id) => () => {
                window.location = `updateMovie?movie_id=${movie_id}`; 
            },
        deleteMovieDoubleCallback:  (movie_id) => () => {
                $
                    .get('deleteMovie/xhrRun', {movie_id})
                    .done((response) => {
                        const deleteSuccess = JSON.parse(response);
                        if (deleteSuccess) {
                            _ui.markMovieAsDeleted(movie_id);
                        }
                    });
            }
    });
}

function requestGenres() {
    $.get('retrieveMovie/xhrGetGenre', (response) => {
        _ui.updateGenreOptions(response);
        _handlerInjector.injectGenreOnChangeHandler();
    }, 'json');
}

function requestYears() {
    $.get('retrieveMovie/xhrGetYear', (response) => {
        _ui.updateYearOptions(response);
        _handlerInjector.injectYearOnChangeHandler();
    }, 'json');
}

function requestInitialMovies() {
    $.get('retrieveMovie/xhrGetNewMovie', {})
        .done((response) => {
            const movies = JSON.parse(response);
            _ui.updateMovieList(movies);
            _handlerInjector.injectMovieItemEventHandlers();
        });
}

function requestMovies(searchParams, updateHistory = true) {
    const onSuccess = (response) => {
        const movies = JSON.parse(response);
        if (movies.length == 0) {
            _ui.reportNoMovieFound();
        } else {
            _ui.updateMovieList(movies);
            _handlerInjector.injectMovieItemEventHandlers();
            requestPageCount(searchParams);
        }
    }
    $.get('retrieveMovie/xhrGetMovie', searchParams).done(onSuccess);
    _currentPage = searchParams.pageNumber;
    if (updateHistory) {
        history.pushState(searchParams, null, null);
    }
}

function requestPageCount(searchParams) {
    const onSuccess = (response) => {
        const pageCount = response;
        _ui.updatePageLinks(pageCount, _currentPage);
        _handlerInjector.injectNavigationHandler(pageCount);
    }
    $.get('retrieveMovie/xhrGetPageCount', searchParams).done(onSuccess);

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