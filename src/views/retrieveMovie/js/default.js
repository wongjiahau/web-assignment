var _currentPage = 0;
$(() => {
    requestMovies();
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
    $('#searchBtn').click(() => requestMovies(0));
    $('#searchInput').keypress((e) => {
        const keyCodeOfEnter = 13;
        if (e.keyCode == keyCodeOfEnter) {
            requestMovies(0);
        }
    });
}

function requestMovies(pageNumber = 0) {
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
        .get('retrieveMovie/xhrGetMovie', getSearchParams(pageNumber))
        .done(onSuccess);
    _currentPage = pageNumber;
}

function requestPageCount() {
    const onSuccess = (response) => {
        const pageCount = response;
        $('#pageLinks').html(renderPageLinks(pageCount, _currentPage));
        for (let i = 0; i < pageCount; i++) {
            $(`#pglink${i + 1}`).click(() => requestMovies(i));
        }
        $('#prevBtn').click(() => requestMovies(_currentPage - 1));
        $('#nextBtn').click(() => requestMovies(_currentPage + 1));
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