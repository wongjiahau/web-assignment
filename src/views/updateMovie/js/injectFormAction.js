$(() => {
    $('#createMovieForm').attr('action', `updateMovie/run?video_id=${CURRENT_VIDEO_ID}`);
});