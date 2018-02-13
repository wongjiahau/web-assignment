<?php

use function Kahlan\describe;
require_once(__ROOT__.'/src/DbLink.php');
describe("DbLink", function() {
    describe("construct", function() {
        it("should directly connect to database name 'aml'", function() {
            expect(function() {
                $x = new DbLink();
            })->not->toThrow();
        });
    });

    describe("sendQuery", function() {
        it("case 1", function() {
            $x = new DbLink();
            $result = $x->sendQuery("select count(*) as vcount from video;");
            expect($result)->toBe(array(0 => array("vcount" => "384")));
        });
    });

    describe("close", function() {
        it("should throw error if sendQuery is called after it", function() {
            $closure = function () {
                $x = new DbLink();
                $x->close();
                $x->sendQuery("select * from video;");
            };
            expect($closure)->toThrow();
        });
    });

});
?>