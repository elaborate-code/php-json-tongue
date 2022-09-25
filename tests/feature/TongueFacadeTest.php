<?php

use ElaborateCode\JsonTongue\Tests\JsonFaker\JsonFaker;
use ElaborateCode\JsonTongue\TongueFacade;

it('trascribes')
    ->expect(function () {
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

        return new TongueFacade($this->jsonFaker->getPath());
    })
    ->transcribe()->toHaveCount(3)
    ->transcribe()->toHaveKey('ar')
    ->transcribeLang('ar')->toHaveCount(0)
    ->transcribe()->toHaveKey('en')
    ->transcribeLang('en')->toHaveCount(5)
    ->transcribeLang('en')->toHaveKey('en')->toContain('en')
    ->transcribeLang('en')->toHaveKey('one')->toContain('one')
    ->transcribeLang('en')->toHaveKey('two')->toContain('two')
    ->transcribeLang('en')->toHaveKey('Hello')->toContain('Hello')
    ->transcribe()->toHaveKey('fr')
    ->transcribeLang('fr')->toHaveCount(1)
    ->transcribeLang('fr')->toHaveKey('Hello')->toContain('Salut');
