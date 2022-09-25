<?php

use ElaborateCode\JsonTongue\Composites\LocaleJson;
use ElaborateCode\JsonTongue\Contracts\LocaleJsonLoader;
use ElaborateCode\JsonTongue\Factories\LocaleFolderFactory;
use ElaborateCode\JsonTongue\JsonFaker\JsonFaker;
use ElaborateCode\JsonTongue\Strategies\File;

it('throws an exception when path is not a valid folder')
    ->expect(fn () => (new LocaleFolderFactory)->make(__FILE__))
    ->throws(Exception::class, 'Invalid absolute folder path '.__FILE__.' on LocaleFolder instantiation');

it('sets locale lang correctly')
    ->expect(function () {
        $this->jsonFaker = JsonFaker::make()
            ->addLocale('en', [])
            ->write();

        return (new LocaleFolderFactory)->make(new File($this->jsonFaker->getPath().'/en'));
    })
    ->getLang()->toBe('en');

it('asserts JsonsList')
    ->expect(function () {
        $this->jsonFaker = JsonFaker::make()
            ->addLocale('en', ['en.json' => []])
            ->write();

        return (new LocaleFolderFactory)->make(new File($this->jsonFaker->getPath().'/en'));
    })
    ->getJsonsList()->toHaveCount(1)
    ->getJsonsList()->toHaveKey('en.json');

it('asserts localeJsonLoadersCollection instances type')
    ->expect(function () {
        $this->jsonFaker = JsonFaker::make()
            ->addLocale('en', [
                'en.json' => [],
                'yo.json' => [],
            ])
            ->write();

        return (new LocaleFolderFactory)->make(new File($this->jsonFaker->getPath().'/en'))
            ->getLocaleJsonLoadersCollection();
    })
    ->toHaveCount(2)
    ->each
    ->toBeInstanceOf(LocaleJson::class)
    ->toBeInstanceOf(LocaleJsonLoader::class);
