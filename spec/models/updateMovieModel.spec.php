<?php

use function Kahlan\describe;
use function Kahlan\expect;
use function Kahlan\it;

//Clean up database
$db = new Model();
$db->queryDb("delete from video where video_id > 384");

require_once(__ROOT__ . '/src/models/updateMovieModel.php');
describe("updateMovieModel", function () {
    describe("getMovie", function () {
        it("case 1", function(){
            $x = new UpdateMovieModel();
            $res = $x->xhrGetMovie('1');
            $res = json_decode($res);
            expect($res->title)->toBe('The Walking Dead');
        });
    });

    describe("run", function() {
        it("should update img_path if img_path is not null", function() {
            $x = new UpdateMovieModel();
            $x->run("98", new Movie(
                "new title",
                "9999",
                "new genre",
                "new img_path",
                "new synopsis"
            ));
            $res = $x->queryDb("select * from video where video_id = 98");
            unset($res[0]['ts']);
            expect($res[0])->toBe(array(
               "video_id" => "98",
               "title" => "new title",
               "year" => "9999",
               "genre" => "new genre",
               "img_path" => "new img_path",
               "synopsis" => "new synopsis"
            ));
        });

        it("should not update img_path if img_path is null", function() {
            $ORIGINAL_IMG_PATH = "https://images-na.ssl-images-amazon.com/images/M/MV5BNzBiYWVjMjgtMTUzYy00YTFlLWE2OWYtMzY3ZmNmYTE0ODg5XkEyXkFqcGdeQXVyNjMxNzcwOTI@._V1_UX67_CR0,0,67,98_AL_.jpg";
            $x = new UpdateMovieModel();
            $x->run("99", new Movie(
                "new title",
                "9999",
                "new genre",
                null,                
                "new synopsis"
            ));
            $res = $x->queryDb("select * from video where video_id = 99");
            unset($res[0]['ts']);
            expect($res[0])->toBe(array(
               "video_id" => "99",
               "title" => "new title",
               "year" => "9999",
               "genre" => "new genre",
               "img_path" => $ORIGINAL_IMG_PATH,
               "synopsis" => "new synopsis"
            ));

        });
    });
});