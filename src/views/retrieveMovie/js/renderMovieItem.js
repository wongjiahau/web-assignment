function renderMovieItem(x) {
    return `<div class='movieItem' id='movieItem${x.video_id}'>
        <table>
            <tr>
                <td>
                    <img class='movieImage' src='${x.img_path}'></img>
                </td>
                <td>
                    <span class='movieItemTitle'>${x.title} (${x.year})</span>
                    <br/>
                    <span class='movieItemGenre'><i>${x.genre}</i></span>
                    <br/>
                    <article class='movieItemSynopsis'>${x.synopsis}</article>
                </td>
            </tr>
            <tr><hr/></tr>
        </table> 
    </div>`;
}
