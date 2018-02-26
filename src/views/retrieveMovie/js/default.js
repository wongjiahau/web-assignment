var _currentPage = 0;
$(() => {
    requestMovies(getSearchParams(0));
    requestGenres();
    requestYears();
    injectEventHandlers();
});

function requestGenres() {
    $.get('retrieveMovie/xhrGetGenre', (response) => {
        response.forEach(x => {
            $('#genreSelect').append(`<option value=${x}>${x}</option>`)
        })
    }, 'json');
}

function requestYears() {
    $.get('retrieveMovie/xhrGetYear', (response) => {
        response.forEach(x => {
            $('#yearSelect').append(`<option value=${x}>${x}</option>`)
        })
    }, 'json');
}

function injectEventHandlers() {
    $('#searchBtn').click(() => requestMovies(getSearchParams(0)));
    $('#searchInput').keypress((e) => {
        const keyCodeOfEnter = 13;
        if (e.keyCode == keyCodeOfEnter) {
            requestMovies(getSearchParams(0));
        }
    });
    window.addEventListener('popstate', function (event) {
        const prevSearchParams = event.state;
        if (prevSearchParams) {
            requestMovies(prevSearchParams, false);
            setSearchParams(prevSearchParams);
        }
    });
}

function requestMovies(searchParams, updateHistory = true) {
    const onSuccess = (response) => {
        const movies = JSON.parse(response);
        $('#movieList').html("");
        if (movies.length == 0) {
            $('#movieList').append("<p>No result found.</p>")
            $('#movieList').append("<a href='javascript:history.back()'>Click here to go back</a>")
        }
        movies.forEach(movie => {
            $('#movieList').append(renderMovieItem(movie));
        });
        requestPageCount(searchParams);
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
        $('#pageLinks').html(renderPageLinks(pageCount, _currentPage));
        for (let i = 0; i < pageCount; i++) {
            $(`#pglink${i + 1}`).click(() => requestMovies(getSearchParams(i)));
        }
        $('#prevBtn').click(() => requestMovies(getSearchParams(_currentPage - 1)));
        $('#nextBtn').click(() => requestMovies(getSearchParams(_currentPage + 1)));
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