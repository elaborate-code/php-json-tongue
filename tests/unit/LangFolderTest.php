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

    expect($lang_folder->getLocalesList())->toContain('ar');
    expect($lang_folder->getLocalesList())->toContain('en');
    expect($lang_folder->getLocalesList())->toContain('es');
    expect($lang_folder->getLocalesList())->toContain('fr');
});
