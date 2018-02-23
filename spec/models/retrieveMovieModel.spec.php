<?php

use function Kahlan\describe;
use function Kahlan\expect;
use function Kahlan\it;

require_once(__ROOT__ . '/src/models/retrieveMovieModel.php');
describe("retrieveMovieModel", function () {
    describe("searchMovie", function () {
        it("case 1", function () {
            $x = new RetrieveMovieModel();
            $res = $x->xhrGetMovie("co");
            // Since there are 16 movies that contain substring 'co', then we
            expect(sizeof(json_decode($res)))->toBe(16);
        });
    });
});