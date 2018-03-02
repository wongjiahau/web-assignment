class MovieItemRenderer {
    constructor(renderWithAdminOptions = false) {
        this.renderWithAdminOptions = renderWithAdminOptions;
    }

    render(x) {
        return `<div class='movieItem' id='movieItem${x.movie_id}'>
        <table>
            <tr>
                <td>
                    <img class='movieImage' src='${x.img_path}'></img>
                </td>
                <td>
                    <span id='movieTitle${x.movie_id}' class='movieItemTitle'>${x.title} (${x.year})</span>
                    <br/>
                    <span class='movieItemGenre'><i>${x.genre}</i></span>
                    <br/>
                    <article class='movieItemSynopsis'>${x.synopsis}</article>
                    ${this.renderWithAdminOptions ? `
                        <div class='adminPanel'>
                            <button tag='${x.movie_id}' class='clickable delBtn'>Delete</button>
                            <button tag='${x.movie_id}' class='clickable editBtn'>Edit</button>
                        </div> ` : "" 
                    }
                </td>
            </tr>
            <tr><hr/></tr>
        </table> 
    </div>`;

    }
}
