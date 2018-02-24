function renderMovieItem(x) {
    return `<div class='movieItem' id='movieItem${x.video_id}'>
        <table>
            <tr>
                <td>
                    <img src='${x.img_path}'></img>
                </td>
                <td>
                    <h3>${x.title} (${x.year})</h3>
                    Genre: ${x.genre} <br>
                    Synopsis: <article>${x.synopsis}</article>
                </td>
            </tr>
        </table> 
    </div>`;
}
