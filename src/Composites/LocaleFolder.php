<?php

namespace ElaborateCode\JsonTongue\Composites;

use ElaborateCode\JsonTongue\Contracts\LocaleFolderLoader;
use ElaborateCode\JsonTongue\Contracts\LocalizationRepositoryContract;

final class LocaleFolder extends LocaleFolderLoader
{
    /* =================================== */
    //             Interface
    /* =================================== */

    public function loadTranslations(LocalizationRepositoryContract $localization_repo): void
    {
        foreach ($this->localeJsonLoadersCollection as $json_name => $locale_json) {
            $localization_repo->merge($this->lang, $locale_json->getContent());
        }
    }
}
