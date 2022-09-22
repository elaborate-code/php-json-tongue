<?php

use ElaborateCode\JsonTongue\Composites\LocaleJson;
use ElaborateCode\JsonTongue\Strategies\File;
use ElaborateCode\JsonTongue\Tests\JsonFaker\JsonFaker;

it('gets JSON content correctly', function () {
    $this->jsonFaker = JsonFaker::make()
        ->addLocale('en', [
            'en.json' => [
                'en' => 'en',
                'Super' => 'Super',
            ],
        ])
        ->write();

    $file = new File($this->jsonFaker->getPath().'/en/en.json');

    $json = new LocaleJson($file);

    $this->assertArrayHasKey('en', $json->getContent());
    $this->assertContains('en', $json->getContent());
});

it('gets multi JSON content correctly', function () {
    $this->jsonFaker = JsonFaker::make()
        ->addLocale('multi', [
            'greetings.json' => [
                'en' => [
                    'Hello' => 'Hello',
                ],
                'fr' => [
                    'Hello' => 'Salut',
                ],
            ],
        ])
        ->write();

    $file = new File($this->jsonFaker->getPath().'/multi/greetings.json');

    $json = new LocaleJson($file);

    $this->assertCount(2, $json->getContent());
    $this->assertArrayHasKey('en', $json->getContent());
    $this->assertArrayHasKey('fr', $json->getContent());

    $this->assertArrayHasKey('Hello', $json->getContent()['en']);
    $this->assertArrayHasKey('Hello', $json->getContent()['fr']);
});
