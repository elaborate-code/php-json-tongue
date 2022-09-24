<?php

use ElaborateCode\JsonTongue\Composites\LocaleFolder;
use ElaborateCode\JsonTongue\Composites\MultiLocaleFolder;
use ElaborateCode\JsonTongue\Contracts\LocaleFolderLoader;
use ElaborateCode\JsonTongue\Factories\LocaleFolderFactory;
use ElaborateCode\JsonTongue\Strategies\File;
use ElaborateCode\JsonTongue\Tests\JsonFaker\JsonFaker;

it('factorise the right interface')
    ->expect(fn () => (new LocaleFolderFactory)->make(__DIR__))
    ->toBeInstanceOf(LocaleFolderLoader::class);

it('factory gives MultiLocaleFolder when folder is multi')
    ->expect(function () {
        $this->jsonFaker = JsonFaker::make()
            ->addLocale('es', ['greetings.json' => ['Hello' => 'Hola']])
            ->write();

        return (new LocaleFolderFactory)->make(new File($this->jsonFaker->getPath().'/es'));
    })
    ->toBeInstanceOf(LocaleFolderLoader::class)
    ->toBeInstanceOf(LocaleFolder::class)
    ->getJsonsList()->toHaveCount(1);

it('factory gives LocaleFolderLoader when folder is not multi')
    ->expect(function () {
        $this->jsonFaker = JsonFaker::make()
            ->addLocale('multi', [
                'greetings.json' => [
                    'en' => ['Hello' => 'Hello'],
                    'fr' => ['Hello' => 'Salut'],
                ],
            ])
            ->write();

        return (new LocaleFolderFactory)->make(new File($this->jsonFaker->getPath().'/multi'));
    })
    ->toBeInstanceOf(LocaleFolderLoader::class)
    ->toBeInstanceOf(MultiLocaleFolder::class)
    ->getJsonsList()->toHaveCount(1);
