<?php

use function Kahlan\describe;
use function Kahlan\expect;
use function Kahlan\it;

require_once(__ROOT__ . '/src/models/deleteMovieModel.php');
describe("deleteMovieModel", function () {
    describe("run", function () {
        it("positive case", function () {
            $x = new DeleteMovieModel();
            $x->queryDb("insert into movie(movie_id, title) values (385, 'for_deleting')");
            $res = $x->queryDb("select count(*) as x from movie");
            expect($res[0]["x"])->toBe("385");
            $success = $x->run("385");
            expect($success)->toBe(true);
            $res = $x->queryDb("select count(*) as x from movie");
            expect($res[0]["x"])->toBe("384");
        });

        it("should return false if delete fails", function () {
            $x = new DeleteMovieModel();
            expect($x->run("999"))->toBe(false);
        });
    });
});
?>