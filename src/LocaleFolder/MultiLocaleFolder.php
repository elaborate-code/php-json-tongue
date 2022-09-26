<?php

namespace ElaborateCode\JsonTongue\LocaleFolder;

use ElaborateCode\JsonTongue\LocaleFolder\Abstracts\LocaleFolderLoader;
use ElaborateCode\JsonTongue\LocalizationRepository\Contracts\LocalizationRepositoryContract;

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
