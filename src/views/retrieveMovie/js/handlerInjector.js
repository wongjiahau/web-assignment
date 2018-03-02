class HandlerInjector {
    constructor(isAdmin, handlers) {
        this.isAdmin = isAdmin;
        this.handlers = handlers;
    }

    init() {
        this._injectSearchHandler();
        this._injectGoBackHandler();
    }

    injectGenreOnChangeHandler() {
        $(Id.genreSelect).change(this.handlers.searchMovieCallback);
    }

    injectYearOnChangeHandler() {
        $(Id.yearSelect).change(this.handlers.searchMovieCallback);
    }

    injectNavigationHandler(pageCount) {
        for (let i = 0; i < pageCount; i++) {
            $(`#pglink${i + 1}`).click(this.handlers.navigateDoubleCallback(i));
        }
        this._injectGoToNextHandler();
        this._injectGoToPrevHandler();
    }

    injectMovieItemEventHandlers() {
        if (this.isAdmin) {
            this._injectCreateMovieHandler();
            this._injectUpdateMovieHandler();
            this._injectDeleteMovieHandler();
        }
    }

    _injectSearchHandler() {
        const callback = this.handlers.searchMovieCallback;
        $(Id.searchBtn).click(callback);
        $(Id.searchInput).keypress((e) => {
            const keyCodeOfEnter = 13;
            if (e.keyCode == keyCodeOfEnter) {
                callback();
            }
        });
    }

    _injectGoToPrevHandler() {
        $(Id.prevBtn).click(this.handlers.goToPrevCallback);
    }

    _injectGoToNextHandler() {
        $(Id.nextBtn).click(this.handlers.goToNextCallback);
    }

    _injectGoBackHandler() {
        $(window).on('popstate', (event) => {
            const prevSearchParams = event.originalEvent.state;
            if (prevSearchParams) {
                this
                    .handlers
                    .goBackdoubleCallback(prevSearchParams)();
            }
        });
    }

    _injectCreateMovieHandler() {
        $(Id.createMoviePanel).click(this.handlers.createMovieCallback);
    }

    _injectUpdateMovieHandler() {
        $('.editBtn')
            .toArray()
            .forEach(x => $(x).click(this.handlers.updateMovieDoubleCallback($(x).attr("tag"))));
    }

    _injectDeleteMovieHandler() {
        $('.delBtn')
            .toArray()
            .forEach(x => $(x).click(() => {
                const movie_id = $(x).attr("tag");
                if (window.confirm(`Are you sure you want to delete "${$(`#movieTitle${movie_id}`).html()}"?
                                    \nWARNING: This action cannot be undone.`)) {
                    this
                        .handlers
                        .deleteMovieDoubleCallback(movie_id)();
                }
            }));
    }

}