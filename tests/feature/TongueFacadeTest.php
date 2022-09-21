<?php

use ElaborateCode\JsonTongue\Tests\JsonFaker\JsonFaker;
use ElaborateCode\JsonTongue\TongueFacade;

it('complete', function () {
    $this->faker = new JsonFaker([
        'ar' => [
            'ar.json' => [],
        ],
        'en' => [
            'en.json' => [
                "en" => "en",
                "Super" => "Super"
            ],
            'one.json' => [
                "one" => "one",
            ],
            'two.json' => [
                "two" => "two",
            ],
        ],
        'multi' => [
            'greetings.json' => [
                'en' => [
                    'Hello' => 'Hello',
                ],
                'fr' => [
                    'Hello' => 'Salut',
                ],
            ],
        ],
    ]);

    $tongue = new TongueFacade('/tests/temp/lang');

    $this->assertCount(3, $tongue->transcribe());
    $this->assertArrayHasKey('ar', $tongue->transcribe());
    $this->assertArrayHasKey('en', $tongue->transcribe());
    $this->assertArrayHasKey('fr', $tongue->transcribe());

    $this->assertCount(0, $tongue->transcribe()['ar']);
    $this->assertCount(5, $tongue->transcribe()['en']);
});
