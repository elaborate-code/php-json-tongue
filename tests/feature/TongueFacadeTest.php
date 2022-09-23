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
                "I know. They're both good. It's hard to decide. McCain is older but he has more experience. Obama seems to have a lot of good ideas, but some people say he wants to raise taxes." => 'Lo sé. Ambos son buenos. Es difícil decidir. McCain es mayor pero tiene más experiencia. Obama parece tener muchas buenas ideas, pero algunas personas dicen que quiere aumentar los impuestos.',
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
