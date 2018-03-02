$(() => {
    // Note: CURRENT_VIDEO_ID is injected as constant in updateMovie.php
    console.log(CURRENT_VIDEO_ID);
    $.get(`updateMovie/xhrGetMovie/${CURRENT_VIDEO_ID}`, (response) => {
        const x = JSON.parse(response);
        $('#TitleInput').val(x.title);
        $('#GenreInput').val(x.genre.split(",").map(x => x.trim()));
        $('#YearInput').val(x.year);
        $('#SynopsisInput').val(x.synopsis);
        $('#selectedImage').attr('src', x.img_path);
        
    });
});