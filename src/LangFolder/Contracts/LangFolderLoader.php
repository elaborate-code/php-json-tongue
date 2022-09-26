<?php

namespace ElaborateCode\JsonTongue\LangFolder\Contracts;

use ElaborateCode\JsonTongue\LocalizationRepository\Contracts\LocalizationRepositoryContract;

interface LangFolderLoader
{
    /**
     * Orders the LocaleFolderLoaders to merge their translations in the LocalizationRepositoryContract
     */
    public function orderLoadingTranslations(LocalizationRepositoryContract $localization_repo): void;
}
