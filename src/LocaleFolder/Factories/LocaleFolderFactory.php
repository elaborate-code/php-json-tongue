<?php

namespace ElaborateCode\JsonTongue\LocaleFolder\Factories;

use ElaborateCode\JsonTongue\LocaleFolder\Abstracts\LocaleFolderLoader;
use ElaborateCode\JsonTongue\LocaleFolder\LocaleFolder;
use ElaborateCode\JsonTongue\LocaleFolder\MultiLocaleFolder;

final class LocaleFolderFactory
{
    public function make(string $abs_path): LocaleFolderLoader
    {
        if (strcmp(strtolower(basename($abs_path)), 'multi') === 0) {
            return new MultiLocaleFolder($abs_path);
        } else {
            return new LocaleFolder($abs_path);
        }
    }
}
