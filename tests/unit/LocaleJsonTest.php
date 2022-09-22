<?php

use ElaborateCode\JsonTongue\Composites\LocaleJson;
use ElaborateCode\JsonTongue\Strategies\File;
use ElaborateCode\JsonTongue\Tests\JsonFaker\JsonFaker;

it('gets JSON content correctly', function () {
    $this->jsonFaker = JsonFaker::make()
        ->addLocale('fr', [
            'misc.json' => [
                'view' => 'vue',
                'Super' => 'Super',
            ],
        ])
        ->write();

    $json = new LocaleJson(new File($this->jsonFaker->getPath().'/fr/misc.json'));

    expect($json->getContent())->toHaveKey('view');
    expect($json->getContent())->toContain('vue');
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

    expect($json->getContent())->toHaveCount(2);

    expect($json->getContent())->toHaveKey('en');
    expect($json->getContent())->toHaveKey('fr');

    expect($json->getContent()['en'])->toHaveKey('Hello');
    expect($json->getContent()['en'])->toContain('Hello');

    expect($json->getContent()['fr'])->toHaveKey('Hello');
    expect($json->getContent()['fr'])->toContain('Salut');
});
