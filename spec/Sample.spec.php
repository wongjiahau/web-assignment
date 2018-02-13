<?php
// This test has a second purpose
// That is it set up global constants as defined below
define('__ROOT__', dirname(dirname(__FILE__)));
require_once(__ROOT__.'/src/Sample.php');
$_SERVER['DOCUMENT_ROOT'] = __ROOT__;

describe("Sample", function() {
    describe("toString", function() {
        it("passes if true === true", function() {
            $x = new Sample();
            echo __ROOT__;
            expect($x->toString())->toBe("This is a sample.");
        });
    });
});
?>