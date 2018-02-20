<?php

use function Kahlan\expect;
require_once(__ROOT__."/src/PaginatorUi.php");
describe("PaginatorUi", function() {
    describe("renderPageLink", function() {
        it("case 1", function() {
            $x = new PaginatorUi(null, null, "handlePageClick");
            $result = $x->renderPageLink(0);
            expect($result)->toBe("<a onclick='handlePageClick(0);'>0</a>");
        });

        it("case 2", function() {
            $x = new PaginatorUi(null, null, "handlePageClick");
            $result = $x->renderPageLink(1);
            expect($result)->toBe("<a onclick='handlePageClick(1);'>1</a>");
        });
    });
});
?>