<?php

use ElaborateCode\JsonTongue\Composites\LocaleJson;
use ElaborateCode\JsonTongue\Strategies\File;
use ElaborateCode\JsonTongue\Tests\JsonFaker\JsonFaker;

it('gets JSON content correctly', function () {
    $faker = new JsonFaker([
        'en' => [
            'en.json' => [
                'en' => 'en',
                'Super' => 'Super',
            ],
        ],
    ]);

    $file = new File('/tests/temp/lang/en/en.json');

    $json = new LocaleJson($file);

    $this->assertArrayHasKey('en', $json->getContent());
    $this->assertContains('en', $json->getContent());
});

it('gets multi JSON content correctly', function () {
    $faker = new JsonFaker([
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

    $file = new File('/tests/temp/lang/multi/greetings.json');

    $json = new LocaleJson($file);

    $this->assertCount(2, $json->getContent());
    $this->assertArrayHasKey('en', $json->getContent());
    $this->assertArrayHasKey('fr', $json->getContent());

    $this->assertArrayHasKey('Hello', $json->getContent()['en']);
    $this->assertArrayHasKey('Hello', $json->getContent()['fr']);
});
