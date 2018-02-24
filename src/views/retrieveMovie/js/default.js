$(() => {
    requestMovies();
    requestGenres();
    requestYears();
    injectEventHandlers();
});

function requestGenres() {
    $.get('retrieveMovie/xhrGetGenre', (response) => {
        response.forEach(x=>{
            $('#genreSelect').append(`<option value=${x}>${x}</option>`)
        })
    }, 'json');
}

function requestYears() {
    $.get('retrieveMovie/xhrGetYear', (response) => {
        response.forEach(x=>{
            $('#yearSelect').append(`<option value=${x}>${x}</option>`)
        })
    }, 'json');
}

function injectEventHandlers() {
    $('#searchBtn').click(requestMovies);
    $('#searchInput').keypress((e) => {
        const keyCodeOfEnter = 13;
        if (e.keyCode == keyCodeOfEnter) {
            requestMovies();
        }
    });
}

function requestMovies() {
    const data = {
        searchWord: $('#searchInput').val(),
        selectedGenre: $('#genreSelect').val(),
        selectedYear: $('#yearSelect').val(),
        pageNumber: ""
    };
    const onSuccess = (response) => {
        const movies = JSON.parse(response);
        $('#movieList').html("");
        if(movies.length == 0) {
            $('#movieList').append("<p>No result found.</p>")
        }
        movies.forEach(movie => {
            $('#movieList').append(renderMovieItem(movie));
        });
    }
    $
        .get('retrieveMovie/xhrGetMovie', data)
        .done(onSuccess);
}