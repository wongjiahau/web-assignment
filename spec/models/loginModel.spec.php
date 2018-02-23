<?php

use function Kahlan\describe;
use function Kahlan\expect;
use function Kahlan\it;

require_once(__ROOT__ . '/src//models/loginModel.php');
describe("loginModel", function () {
    describe("run", function () {
        it("positive case", function () {
            $x = new LoginModel();
            $correctId = 'admin';
            $correctPassword = '1234';
            $newState = $x->run($correctId, $correctPassword);
            expect($newState)->toBe(
                array(
                    'url' => 'dashboard',
                    'session' => array(
                        'key' => 'loggedIn',
                        'value' => true
                    )
                )
            );
        });

        it("negative case", function () {
            $x = new LoginModel();
            $correctId = 'admin';
            $wrongPassword = '99999';
            $newState = $x->run($correctId, $wrongPassword);
            expect($newState)->toBe(
                array(
                    'url' => 'login',
                )
            );
        });
    });
});
?>