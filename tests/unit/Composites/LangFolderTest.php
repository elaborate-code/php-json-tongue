<?php

use ElaborateCode\JsonTongue\Composites\LangFolder;
use ElaborateCode\JsonTongue\Contracts\LangFolderLoader;
use ElaborateCode\JsonTongue\Contracts\LocaleFolderLoader;
use ElaborateCode\JsonTongue\Tests\JsonFaker\JsonFaker;

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
