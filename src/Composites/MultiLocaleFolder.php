<?php

namespace ElaborateCode\JsonTongue\Composites;

use ElaborateCode\JsonTongue\Contracts\LocaleFolderLoader;
use ElaborateCode\JsonTongue\LocalizationRepository;

final class MultiLocaleFolder extends LocaleFolderLoader
{
    /* =================================== */
    //             Interface
    /* =================================== */

    public function loadTranslations(LocalizationRepository $localization_repo): void
    {
        foreach ($this->localeJsonLoadersCollection as $json_name => $multi_locale_json) {
            foreach ($multi_locale_json->getContent() as $lang => $locale) {
                $localization_repo->merge($lang, $locale);
            }
        }
    }
}
