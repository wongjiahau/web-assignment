<?php

use function Kahlan\describe;
use function Kahlan\expect;
use function Kahlan\it;

function has_duplicate($array)
{
    return count($array) !== count(array_unique($array));
}

function is_sorted($array)
{
    $a = $array;
    $b = $array;
    sort($b);
    if ($a == $b) {
        return true;
    } else {
        return false;
    }
}

//Clean up database
$db = new Model();
$db->queryDb("delete from video where video_id > 384");

require_once(__ROOT__ . '/src/models/retrieveMovieModel.php');
require_once(__ROOT__ . '/src/models/createMovieModel.php');
describe("retrieveMovieModel", function () {
    describe("xhrGetMovie", function () {
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

        it("should sort movies based on descending years", function () {
            $x = new RetrieveMovieModel();
            $res1 = $x->xhrGetMovie("", "", "", 0);
            $res2 = $x->xhrGetMovie("", "", "", 10);
            $res1 = json_decode($res1);
            $res2 = json_decode($res2);
            expect($res1[0]->year)->toBeGreaterThan($res2[0]->year);
        });
    });

    describe("xhrGetGenre", function () {
        it("case 1", function () {
            $x = new RetrieveMovieModel();
            $res = json_decode($x->xhrGetGenre());
            expect(sizeof($res))->toBe(23);
        });

        it("should not contain duplicates", function () {
            $x = new RetrieveMovieModel();
            $res = json_decode($x->xhrGetGenre());
            expect(has_duplicate($res))->toBe(false);
        });

        it("should be sorted", function () {
            $x = new RetrieveMovieModel();
            $res = json_decode($x->xhrGetGenre());
            expect(is_sorted($res))->toBe(true);
        });
    });

    describe("xhrGetYear", function () {
        it("should not contain duplicates", function () {
            $x = new RetrieveMovieModel();
            $res = json_decode($x->xhrGetYear());
            expect(has_duplicate($res))->toBe(false);
        });

        it("should be sorted", function () {
            $x = new RetrieveMovieModel();
            $res = json_decode($x->xhrGetYear());
            expect(is_sorted($res))->toBe(true);
        });
    });

    describe("xhrGetPageCount", function () {
        it("case 1", function () {
            $x = new RetrieveMovieModel();
            $res = json_decode($x->xhrGetPageCount("walking"));
            expect($res)->toBe(1);
        });

        it("case 2", function () {
            $x = new RetrieveMovieModel();
            $res = json_decode($x->xhrGetPageCount("", "", ""));
            expect($res)->toBe(39);
        });
    });

    describe("getNewMovies", function () {
        it("case 1", function () {
            $c = new CreateMovieModel();
            $c->run(
                new Movie("Newly inserted", "1999", "", "", "")
            );
            $x = new RetrieveMovieModel();
            $res = json_decode($x->xhrGetNewMovie());
            expect($res[0]->title)->toBe("Newly inserted");
            $x->queryDb("delete from video where title = 'Newly inserted'");
        });
    });
});