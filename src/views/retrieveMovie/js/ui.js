const Id = {
    searchBtn: '#searchBtn',
    searchInput: '#searchInput',
    genreSelect: '#genreSelect',
    yearSelect: '#yearSelect',
    movieList: '#movieList',
    createMoviePanel: '#createMoviePanel',
    pageLinks: '#pageLinks',
    prevBtn: '#prevBtn',
    nextBtn: '#nextBtn',
    editBtn: '#editBtn',
    delBtn: '#delBtn'
};

class Ui {
    constructor(renderWithAdminOptions) {
        this.renderWithAdminOptions = renderWithAdminOptions;
        if(renderWithAdminOptions) {
            this.renderCreateMovieButton();
        }
    }

    updatePageLinks(pageCount, currentPage) {
        $(Id.pageLinks).html(renderPageLinks(pageCount, currentPage));
    }

    updateMovieList(movies) {
        $(Id.movieList).html("");
        const x = new MovieItemRenderer(this.renderWithAdminOptions);
        movies.forEach(movie => {
            $(Id.movieList).append(x.render(movie));
        });
        if(this.renderWithAdminOptions) {
        }
    }

    reportNoMovieFound() {
        $(Id.movieList).html("");
        $(Id.movieList).append("<p>No result found.</p>")
        $(Id.movieList).append("<a href='javascript:history.back()'>Click here to go back</a>")
    }

    updateGenreOptions(options) {
        options.forEach(x => {
            $(Id.genreSelect).append(`<option value=${x}>${x}</option>`);
        });
    }

    updateYearOptions(options) {
        options.forEach(x => {
            $(Id.yearSelect).append(`<option value=${x}>${x}</option>`)
        })
    }

    renderCreateMovieButton() {
        $(Id.createMoviePanel).html(`<button class='clickable createBtn'>Add new movie</button>`);
    }

    markMovieAsDeleted(movie_id) {
        $(`#movieItem${movie_id}`).fadeTo('slow', 0.33);
        $(`#movieItem${movie_id}`).append(`<span class='deleted'><b>DELETED</b></span>`);
    }
};
