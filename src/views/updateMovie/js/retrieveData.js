$(() => {
    // Note: CURRENT_movie_id is injected as constant in updateMovie.php
    console.log(CURRENT_movie_id);
    $.get(`updateMovie/xhrGetMovie/${CURRENT_movie_id}`, (response) => {
        const x = JSON.parse(response);
        $('#TitleInput').val(x.title);
        $('#GenreInput').val(x.genre.split(",").map(x => x.trim()));
        $('#YearInput').val(x.year);
        $('#SynopsisInput').val(x.synopsis);
        $('#selectedImage').attr('src', x.img_path);
        
    });
});