<?php

use function Kahlan\expect;
use function Kahlan\describe;
use function Kahlan\it;

require_once(__ROOT__ . '/src/Paginator.php');
require_once(__ROOT__ . '/src/QueryBuilder.php');

describe("Paginator", function () {
    describe("countifyQuery", function () {
        it("case 1", function () {
            $x = new Paginator(null, Q()->fromVideo->selectCount);
            $result = $x->countifyQuery("select * from video;");
            expect($result)->toBe("select count(*) from video;");
        });

        it("case 2", function () {
            $x = new Paginator(null, null);
            $result = $x->countifyQuery("select * from video where id='hello';");
            expect($result)->toBe("select count(*) from video where id='hello';");
        });
    });

    describe("getPage", function () {
        it("case 1", function () {
            $x = new Paginator(new DbLink(), Q()->fromVideo->selectAll);
            $result = $x->getPage(0);
            expect(sizeof($result))->toBe(10);
            expect($result[0]["title"])->toBe("The Walking Dead");
            expect($result[9]["title"])->toBe("Luther");
        });

        it("case 2", function () {
            $x = new Paginator(new DbLink(), Q()->fromVideo->selectAll);
            $result = $x->getPage(1);
            expect(sizeof($result))->toBe(10);
            expect($result[0]["title"])->toBe("Justified");
            expect($result[9]["title"])->toBe("Black Swan");
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