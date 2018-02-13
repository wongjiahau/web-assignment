<?php

use function Kahlan\expect;
require_once(__ROOT__.'/src/Paginator.php');

describe("Paginator", function() {
    describe("countifyQuery", function() {
        it("case 1", function() {
            $x = new Paginator(NULL, NULL);
            $result = $x->countifyQuery("select * from video;");
            expect($result)->toBe("select count(*) from video;");
        });

        it("case 2", function() {
            $x = new Paginator(NULL, NULL);
            $result = $x->countifyQuery("select * from video where id='hello';");
            expect($result)->toBe("select count(*) from video where id='hello';");
        });
    });
});
?>