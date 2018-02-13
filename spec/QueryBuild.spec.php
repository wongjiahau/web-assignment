<?php

use function Kahlan\it;
use function Kahlan\describe;
require_once(__ROOT__.'/src/QueryBuilder.php');
describe("QueryBuilder", function() {
    it("should be instantiated with Q()", function(){
        $x = Q();
        expect(get_class($x))->toBe("QueryBuilder");
    });

    it("case 1", function(){
        $x = Q()->fromVideo->selectCount;
        expect($x->undelimited())->toBe("select count(*) from video");
    });

    describe("undelimited", function(){
        it("case 1", function(){
            $query = Q()->fromVideo->selectAll;
            expect($query->undelimited())->toBe("select * from video");
        });
    });

    describe("delimited", function(){
        it("case 1", function(){
            $query = Q()->fromVideo->selectAll;
            expect($query->delimited())->toBe("select * from video;");
        });
    });
});
?>