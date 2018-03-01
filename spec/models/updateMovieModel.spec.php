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
});