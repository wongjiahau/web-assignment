<?php

use function Kahlan\describe;
use function Kahlan\expect;
use function Kahlan\it;
use function Kahlan\beforeAll;
use function Kahlan\beforeEach;
use function Kahlan\afterEach;
use function Kahlan\afterAll;


require_once(__ROOT__ . '/src/models/updateMovieModel.php');
require_once(__ROOT__ . '/src/models/createMovieModel.php');

describe("updateMovieModel", function () {
    beforeEach(function() {
        $db = new Model();
        $db->queryDb("delete from movie where movie_id > 384");
        $x = new CreateMovieModel();
        $x->run(new Movie(
            "original title",
            "original year",
            "original genre",
            "original img_path",
            "original synopsis"
        ));
    });

    afterAll(function(){
        $db = new Model();
        $db->queryDb("delete from movie where movie_id > 384");
    });

    describe("getMovie", function () {
        it("case 1", function () {
            $x = new UpdateMovieModel();
            $res = $x->xhrGetMovie('1');
            $res = json_decode($res);
            expect($res->title)->toBe('The Walking Dead');
        });
    });

    describe("run", function () {
        it("should update img_path if img_path is not null", function () {
            $x = new UpdateMovieModel();
            $movie_id = "385";
            $x->run($movie_id, new Movie(
                "new title",
                "9999",
                "new genre",
                "new img_path",
                "new synopsis"
            ));
            $res = $x->queryDb("select * from movie where movie_id = $movie_id");
            unset($res[0]['ts']);
            expect($res[0])->toBe(array(
                "movie_id" => $movie_id,
                "title" => "new title",
                "year" => "9999",
                "genre" => "new genre",
                "img_path" => "new img_path",
                "synopsis" => "new synopsis"
            ));
        });

        it("should not update img_path if img_path is null", function () {
            $x = new UpdateMovieModel();
            $movie_id = "385";
            $x->run($movie_id, new Movie(
                "new title",
                "9999",
                "new genre",
                null,
                "new synopsis"
            ));
            $res = $x->queryDb("select * from movie where movie_id = $movie_id");
            unset($res[0]['ts']);
            expect($res[0])->toBe(array(
                "movie_id" => $movie_id,
                "title" => "new title",
                "year" => "9999",
                "genre" => "new genre",
                "img_path" => "original img_path",
                "synopsis" => "new synopsis"
            ));

        });
    });
});