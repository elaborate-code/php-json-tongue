<?php

use ElaborateCode\JsonTongue\Factories\LocaleFolderFactory;
use ElaborateCode\JsonTongue\Strategies\File;
use ElaborateCode\JsonTongue\Tests\JsonFaker\JsonFaker;

it('sets locale lang correctly', function () {
    $this->jsonFaker = JsonFaker::make()
        ->addLocale('en', [])
        ->write();

    $factory = new LocaleFolderFactory;

    $en = new File($this->jsonFaker->getPath().'/en');

    $locale = $factory->make($en);

    $this->assertEquals($locale->getLang(), 'en');

    // $this->assertFalse($locale->isMulti()); // test instance
});

it('assert JsonsList', function () {
    $this->jsonFaker = JsonFaker::make()
        ->addLocale('en', ['en.json' => []])
        ->write();

    $factory = new LocaleFolderFactory;

    $en = new File($this->jsonFaker->getPath().'/en');

    $locale = $factory->make($en);

    $this->assertArrayHasKey('en.json', $locale->getJsonsList());
});
