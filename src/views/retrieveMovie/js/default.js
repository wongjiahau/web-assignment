$(() => {
    $.get('retrieveMovie/xhrGetMovie', (response) => {
        response.forEach(movie => {
            $('#movieList').append(renderMovieItem(movie));
        });
    }, 'json');
});