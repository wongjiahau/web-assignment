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
    static injectCreateMovieHandler(callback) {
        $(Id.createMoviePanel).click(callback);
    }

    static injectUpdateMovieHandler(editMovieDoubleCallback, deleteMovieDoubleCallback) {
        $('.editBtn')
            .toArray()
            .forEach(x => $(x).click(editMovieDoubleCallback($(x).attr("tag"))));
        $('.delBtn')
            .toArray()
            .forEach(x => $(x).click(deleteMovieDoubleCallback($(x).attr("tag"))));
    }
    static injectSearchHandler(callback) {
        $(Id.searchBtn).click(callback);
        $(Id.searchInput).keypress((e) => {
            const keyCodeOfEnter = 13;
            if (e.keyCode == keyCodeOfEnter) {
                callback();
            }
        });
        $(Id.genreSelect).change(callback);
        $(Id.yearSelect).change(callback);
    }

    static injectNavigationHandler(pageCount, doubleCallback) {
        for (let i = 0; i < pageCount; i++) {
            $(`#pglink${i + 1}`).click(doubleCallback(i));
        }
    }

    static injectGoToPrevHandler(callback) {
        $(Id.prevBtn).click(callback);
    }

    static injectGoToNextHandler(callback) {
        $(Id.nextBtn).click(callback);
    }

    static injectGoBackHandler(doubleCallback) {
        $(window).on('popstate', (event) => {
            const prevSearchParams = event.originalEvent.state;
            if (prevSearchParams) {
                doubleCallback(prevSearchParams)();
            }
        });
    }

    static updatePageLinks(pageCount, currentPage) {
        $(Id.pageLinks).html(renderPageLinks(pageCount, currentPage));
    }

    static updateMovieList(movies, renderWithAdminOptions = false) {
        const x = new MovieItemRenderer(renderWithAdminOptions);
        movies.forEach(movie => {
            $(Id.movieList).append(x.render(movie));
        });
    }
    static clearMovieList() {
        $(Id.movieList).html("");
    }

    static reportNoMovieFound() {
        $(Id.movieList).append("<p>No result found.</p>")
        $(Id.movieList).append("<a href='javascript:history.back()'>Click here to go back</a>")
    }

    static updateGenreOptions(options) {
        options.forEach(x => {
            $(Id.genreSelect).append(`<option value=${x}>${x}</option>`)
        });
    }

    static updateYearOptions(options) {
        options.forEach(x => {
            $(Id.yearSelect).append(`<option value=${x}>${x}</option>`)
        })
    }

    static renderCreateMovieButton() {
        $(Id.createMoviePanel).html(`<button class='clickable createBtn'>Add new movie</button>`);
    }

    static markMovieAsDeleted(video_id) {
        $(`#movieItem${video_id}`).fadeTo('slow', 0.33);
        $(`#movieItem${video_id}`).append(`<span class='deleted'><b>DELETED</b></span>`);
    }
};
