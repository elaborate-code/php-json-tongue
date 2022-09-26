<?php

use ElaborateCode\JsonTongue\JsonFaker\JsonFaker;
use ElaborateCode\JsonTongue\LocaleFolder\Abstracts\LocaleFolderLoader;
use ElaborateCode\JsonTongue\LocaleFolder\Factories\LocaleFolderFactory;
use ElaborateCode\JsonTongue\LocaleFolder\LocaleFolder;
use ElaborateCode\JsonTongue\LocaleFolder\MultiLocaleFolder;
use ElaborateCode\JsonTongue\Strategies\File;

it('factorise the right interface')
    ->expect(fn () => (new LocaleFolderFactory)->make(__DIR__))
    ->toBeInstanceOf(LocaleFolderLoader::class);

it('factory gives LocaleFolder when folder is not multi')
    ->expect(function () {
        $this->jsonFaker = JsonFaker::make()
            ->addLocale('es', ['greetings.json' => ['Hello' => 'Hola']])
            ->write();

        return (new LocaleFolderFactory)->make(new File($this->jsonFaker->getPath().'/es'));
    })
    ->toBeInstanceOf(LocaleFolderLoader::class)
    ->toBeInstanceOf(LocaleFolder::class)
    ->getJsonsList()->toHaveCount(1);

it('factory gives MultiLocaleFolder when folder is multi')
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
