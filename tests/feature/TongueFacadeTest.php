<?php

use ElaborateCode\JsonTongue\Tests\JsonFaker\JsonFaker;
use ElaborateCode\JsonTongue\TongueFacade;

it('complete', function () {
    $this->jsonFaker = JsonFaker::make()
        ->addLocale('ar', [
            'ar.json' => [],
        ])
        ->addLocale('en', [
            'en.json' => [
                'en' => 'en',
                'Super' => 'Super',
            ],
            'one.json' => [
                'one' => 'one',
            ],
            'two.json' => [
                'two' => 'two',
            ],
        ])
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

    $tongue = new TongueFacade($this->jsonFaker->getPath());

    expect($tongue->transcribe())
        ->toHaveCount(3);

    expect($tongue->transcribe())
        ->toHaveKey('ar');
    expect($tongue->transcribe())
        ->toHaveKey('en');
    expect($tongue->transcribe())
        ->toHaveKey('fr');

    expect($tongue->transcribe()['ar'])
        ->toHaveCount(0);
    expect($tongue->transcribe()['en'])
        ->toHaveCount(5);
    expect($tongue->transcribe()['fr'])
        ->toHaveCount(1);
});
