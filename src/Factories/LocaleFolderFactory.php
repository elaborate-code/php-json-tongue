<?php

namespace ElaborateCode\JsonTongue\Factories;

use ElaborateCode\JsonTongue\Composites\LocaleFolder;
use ElaborateCode\JsonTongue\Composites\MultiLocaleFolder;
use ElaborateCode\JsonTongue\Contracts\LocaleFolderLoader;

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
