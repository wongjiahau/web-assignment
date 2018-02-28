<?php

use function Kahlan\describe;
use function Kahlan\expect;
use function Kahlan\it;

require_once(__ROOT__ . '/src/models/createMovieModel.php');
describe("createMovieModel", function () {
    describe("run", function () {
        it("positive case", function () {
            $x = new CreateMovieModel();
            $x->run(
                new Movie(
                    "Sample movie",
                    "2012",
                    "Comedy",
                    "google.com",
                    "This is a sample"
                )
            );
            $data = $x->queryDb("select * from video where title='Sample movie'")[0];
            unset($data["ts"]); // unset timestamp property
            expect($data)->toBe(array(
                "video_id" => "385",
                "title"    => "Sample movie",
                "year"     => "2012",
                "genre"    => "Comedy",
                "img_path" => "google.com",
                "synopsis" => "This is a sample"
            ));
            $x->queryDb("delete from video where title='Sample movie'");
        });
    });
});
?>