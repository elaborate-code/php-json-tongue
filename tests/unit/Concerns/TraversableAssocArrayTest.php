<?php

use ElaborateCode\JsonTongue\Concerns\TraversableAssocArray;



it('traverses', function () {
    $obj = new class
    {
        use TraversableAssocArray;

        public array $assoc = [
            'one' => 1,
            'two' => 2,
            'three' => 3,
        ];

        public function __construct()
        {
            $this->traversableAssocPropertyName = 'assoc';
        }
    };

    $i = 0;
    foreach ($obj->assoc as $key => $value) {
        expect($key)->toBeString();
        expect($value)->toBeInt();
        $i++;
    }

    expect($i)->toBe(3);
});
