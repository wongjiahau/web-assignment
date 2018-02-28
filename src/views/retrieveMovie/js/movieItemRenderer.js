class MovieItemRenderer {
    constructor(renderWithAdminOptions = false) {
        this.renderWithAdminOptions = renderWithAdminOptions;
    }

    render(x) {
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
                    ${this.renderWithAdminOptions ? `
                        <div class='adminPanel'>
                            <button tag='${x.video_id}' class='clickable delBtn'>Delete</button>
                            <button tag='${x.video_id}' class='clickable editBtn'>Edit</button>
                        </div> ` : "" 
                    }
                </td>
            </tr>
            <tr><hr/></tr>
        </table> 
    </div>`;

    }
}
