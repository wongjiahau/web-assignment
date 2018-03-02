$(() => {
    $('#createMovieForm').attr('action', `updateMovie/run?movie_id=${CURRENT_movie_id}`);
});