<?php

namespace ElaborateCode\JsonTongue\Contracts;

interface LangFolderLoader
{
    /**
     * Orders the LocaleFolderLoaders to merge their translations in the LocalizationRepository
     */
    public function orderLoadingTranslations(LocalizationRepository $localization_repo): void;
}
