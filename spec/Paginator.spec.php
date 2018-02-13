<?php

use function Kahlan\expect;
use function Kahlan\describe;
use function Kahlan\it;

require_once(__ROOT__ . '/src/Paginator.php');
require_once(__ROOT__ . '/src/QueryBuilder.php');

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

    describe("getPage", function () {
        it("case 1", function () {
            $page_number = 0;
            $x = new Paginator(new DbLink(), Q()->fromVideo->selectAll, $page_number);
            $result = $x->getPage();
            expect(sizeof($result))->toBe(10);
            expect($result[0]["title"])->toBe("The Walking Dead");
            expect($result[9]["title"])->toBe("Luther");
        });

        it("case 2", function () {
            $page_number = 1;
            $x = new Paginator(new DbLink(), Q()->fromVideo->selectAll, $page_number);
            $result = $x->getPage();
            expect(sizeof($result))->toBe(10);
            expect($result[0]["title"])->toBe("Justified");
            expect($result[9]["title"])->toBe("Black Swan");
        });

        
    });

    describe("getTotalCount", function () {
        it("case 1", function () {
            $x = new Paginator(new DbLink(), Q()->fromVideo->selectAll);
            expect($x->getTotalCount())->toBe(384);
        });
    });

    describe("getTotalPageCount", function () {
        it("case 1", function () {
            $x = new Paginator(new DbLink(), Q()->fromVideo->selectAll);
            expect($x->getTotalPageCount())->toBe(39);
        });
    });

    describe("getGlue", function() {
        it("case 1", function(){
            $x = new Paginator(new DbLink(), Q()->fromVideo->selectAll, 0);
            $result = $x->getGlue();
            expect($result["currentPage"])->toBe(0);
            expect($result["totalPageCount"])->toBe(39);
            expect($result["pageData"])->toBe($x->getPage());
        });
    });


});
?>