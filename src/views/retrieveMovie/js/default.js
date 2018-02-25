var _currentPage = 0;
$(() => {
    // history.pushState(null, null, "www.google.com");
    window.addEventListener('popstate', function (event) {
        console.log("yo");
        //TODO: pop search history
    });
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
}

function requestMovies(searchParams) {
    const onSuccess = (response) => {
        const movies = JSON.parse(response);
        $('#movieList').html("");
        if (movies.length == 0) {
            $('#movieList').append("<p>No result found.</p>")
        }
        movies.forEach(movie => {
            $('#movieList').append(renderMovieItem(movie));
        });
        requestPageCount();
    }
    $
        .get('retrieveMovie/xhrGetMovie', searchParams)
        .done(onSuccess);
    _currentPage = searchParams.pageNumber;
}

function requestPageCount() {
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
        .get('retrieveMovie/xhrGetPageCount', getSearchParams(0))
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