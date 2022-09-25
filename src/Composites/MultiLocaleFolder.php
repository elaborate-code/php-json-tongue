<?php

namespace ElaborateCode\JsonTongue\Composites;

use ElaborateCode\JsonTongue\Contracts\LocaleFolderLoader;
use ElaborateCode\JsonTongue\Contracts\LocalizationRepositoryContract;

final class MultiLocaleFolder extends LocaleFolderLoader
{
    /* =================================== */
    //             Interface
    /* =================================== */

    public function loadTranslations(LocalizationRepositoryContract $localization_repo): void
    {
        foreach ($this->localeJsonLoadersCollection as $json_name => $multi_locale_json) {
            foreach ($multi_locale_json->getContent() as $lang => $locale) {
                $localization_repo->merge($lang, $locale);
            }
        }
    }
}
