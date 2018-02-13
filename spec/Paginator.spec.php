<?php

use function Kahlan\expect;
use function Kahlan\describe;
use function Kahlan\it;

require_once(__ROOT__ . '/src/Paginator.php');

describe("Paginator", function () {
    describe("countifyQuery", function () {
        it("case 1", function () {
            $x = new Paginator(null, null);
            $result = $x->countifyQuery("select * from video;");
            expect($result)->toBe("select count(*) from video;");
        });

        it("case 2", function () {
            $x = new Paginator(null, null);
            $result = $x->countifyQuery("select * from video where id='hello';");
            expect($result)->toBe("select count(*) from video where id='hello';");
        });
    });

    describe("getData", function () {
        it("case 1", function () {
            $x = new Paginator(new DbLink(), "select * from video;");
        });
    });

    describe("getTotalCount", function () {
        it("case 1", function () {
            $x = new Paginator(new DbLink(), "select * from video;");
            expect($x->getTotalCount())->toBe(384);
        });
    });


});
?>