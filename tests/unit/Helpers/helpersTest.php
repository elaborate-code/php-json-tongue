<?php

use ElaborateCode\JsonTongue\Strategies\File;

test('is_json:FALSE')
    ->expect([
        is_json(__FILE__),
        is_json(__DIR__),
        is_json(new File('/composer.lock')),
    ])
    ->each
    ->toBeFalse();

test('is_json:TRUE')
    ->expect(is_json(new File('/composer.json')))
    ->toBeTrue();

test('rm_tree');
