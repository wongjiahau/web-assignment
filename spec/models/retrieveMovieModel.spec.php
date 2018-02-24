<?php

use function Kahlan\describe;
use function Kahlan\expect;
use function Kahlan\it;

require_once(__ROOT__ . '/src/models/retrieveMovieModel.php');
describe("retrieveMovieModel", function () {
    describe("searchMovie", function () {
        it("case 1", function () {
            $x = new RetrieveMovieModel();
            $res = $x->xhrGetMovie("world");
            // Since there are 6 movies that contain substring 'world', then we
            expect(sizeof(json_decode($res)))->toBe(6);
        });

        it("page 2 of movies contain name of 'co' should have 6 movies", function () {
            $x = new RetrieveMovieModel();
            $pageNo = 1; // zero-indexed
            $res = $x->xhrGetMovie("co", "", "", $pageNo);
            expect(sizeof(json_decode($res)))->toBe(6);
        });
    });
});