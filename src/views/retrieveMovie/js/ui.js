class Ui {
    static injectSearchHandler(callback) {
        $('#searchBtn').click(callback);
        $('#searchInput').keypress((e) => {
            const keyCodeOfEnter = 13;
            if (e.keyCode == keyCodeOfEnter) {
                callback();
            }
        });
    }

    static injectNavigationHandler(pageCount, doubleCallback) {
        for (let i = 0; i < pageCount; i++) {
            $(`#pglink${i + 1}`).click(doubleCallback(i));
        }
    }

    static injectGoToPrevHandler(callback) {
        $('#prevBtn').click(callback);
    }

    static injectGoToNextHandler(callback) {
        $('#nextBtn').click(callback);
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
        $('#pageLinks').html(renderPageLinks(pageCount, currentPage));
    }

    static updateMovieList(movies) {
        movies.forEach(movie => {
            $('#movieList').append(renderMovieItem(movie));
        });
    }
    static clearMovieList() {
        $('#movieList').html("");
    }

    static reportNoMovieFound() {
        $('#movieList').append("<p>No result found.</p>")
        $('#movieList').append("<a href='javascript:history.back()'>Click here to go back</a>")
    }

    static updateGenreOptions(options) {
        options.forEach(x => {
            $('#genreSelect').append(`<option value=${x}>${x}</option>`)
        });
    }

    static updateYearOptions(options) {
        options.forEach(x => {
            $('#yearSelect').append(`<option value=${x}>${x}</option>`)
        })
    }

};
