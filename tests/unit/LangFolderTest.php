<?php

use ElaborateCode\JsonTongue\Composites\LangFolder;
use ElaborateCode\JsonTongue\Tests\JsonFaker\JsonFaker;

it('lists available locales correctly', function () {
    $this->jsonFaker = JsonFaker::make()
        ->addLocale('ar', [])
        ->addLocale('en', [])
        ->addLocale('es', [])
        ->addLocale('fr', [])
        ->write();

    $lang_folder = new LangFolder($this->jsonFaker->getPath());

    $this->assertContains('ar', $lang_folder->getLocalesList());
    $this->assertContains('en', $lang_folder->getLocalesList());
    $this->assertContains('es', $lang_folder->getLocalesList());
    $this->assertContains('fr', $lang_folder->getLocalesList());
});
