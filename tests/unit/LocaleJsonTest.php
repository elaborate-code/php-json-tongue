<?php

use ElaborateCode\JsonTongue\Composites\LocaleJson;
use ElaborateCode\JsonTongue\Strategies\File;
use ElaborateCode\JsonTongue\Tests\JsonFaker\JsonFaker;

it('throws an exception when path is not a valid JSON')
    ->expect(fn () => new LocaleJson(__FILE__))
    ->throws(Exception::class, 'Invalid absolute JSON path '.__FILE__.' on LocaleJson instantiation');

it('gets JSON content correctly')
    ->expect(function () {
        $this->jsonFaker = JsonFaker::make()
            ->addLocale('fr', [
                'misc.json' => [
                    'view' => 'vue',
                    'Super' => 'Super',
                ],
            ])
            ->write();

        return new LocaleJson(new File($this->jsonFaker->getPath().'/fr/misc.json'));
    })
    ->getContent()->toHaveCount(2)
    ->getContent()->toHaveKey('view')
    ->getContent()->toContain('vue');

it('gets multi JSON content correctly')
    ->expect(function () {
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

        return new LocaleJson($file);
    })
    ->getContent()->toHaveCount(2)
    ->getContent()->toHaveKey('en')
    ->getContent()->toHaveKey('fr')
    ->key('en')->toHaveCount(1)
    ->key('en')->toHaveKey('Hello')
    ->key('en')->toContain('Hello')
    ->key('fr')->toHaveCount(1)
    ->key('fr')->toHaveKey('Hello')
    ->key('fr')->toContain('Salut');

test('handle JSON content is empty or invalid');
