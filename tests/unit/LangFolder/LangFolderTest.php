<?php

use ElaborateCode\JsonTongue\JsonFaker\JsonFaker;
use ElaborateCode\JsonTongue\LangFolder\Contracts\LangFolderLoader;
use ElaborateCode\JsonTongue\LangFolder\LangFolder;
use ElaborateCode\JsonTongue\LocaleFolder\Abstracts\LocaleFolderLoader;

it('lists available locales correctly')
    ->expect(function () {
        $this->jsonFaker = JsonFaker::make()
            ->addLocale('ar', [])
            ->addLocale('en', [])
            ->addLocale('es', [])
            ->addLocale('fr', [])
            ->write();

        return new LangFolder($this->jsonFaker->getPath());
    })
    ->toBeInstanceOf(LangFolderLoader::class)
    ->getLocalesList()->toContain('ar')
    ->getLocalesList()->toContain('en')
    ->getLocalesList()->toContain('es')
    ->getLocalesList()->toContain('fr')
    ->getLocaleLoadersCollection()->toHaveCount(4)
    ->getLocaleLoadersCollection()
    ->each
    ->toBeInstanceOf(LocaleFolderLoader::class);
