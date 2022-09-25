<?php

namespace ElaborateCode\JsonTongue\Contracts;

interface LangFolderLoader
{
    /**
     * Orders the LocaleFolderLoaders to merge their translations in the LocalizationRepositoryContract
     */
    public function orderLoadingTranslations(LocalizationRepositoryContract $localization_repo): void;
}
