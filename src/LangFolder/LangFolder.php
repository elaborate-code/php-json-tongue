<?php

namespace ElaborateCode\JsonTongue\LangFolder;

use ElaborateCode\JsonTongue\LangFolder\Contracts\LangFolderLoader;
use ElaborateCode\JsonTongue\LocaleFolder\Abstracts\LocaleFolderLoader;
use ElaborateCode\JsonTongue\LocaleFolder\Factories\LocaleFolderFactory;
use ElaborateCode\JsonTongue\LocalizationRepository\Contracts\LocalizationRepositoryContract;
use ElaborateCode\JsonTongue\Strategies\File;

final class LangFolder implements LangFolderLoader
{
    protected File $directory;

    protected LocaleFolderFactory $localeFolderFactory;

    /**
     * @var array<LocaleFolderLoader> 'lang_code' => LocaleFolderLoader instance
     */
    protected array $localeLoadersCollection;

    /**
     * @param  string  $lang_path Lang directory path from the project root
     */
    public function __construct(string $lang_path = '/lang')
    {
        // ! IOC
        $this->directory = new File($lang_path);

        // ! IOC
        $this->localeFolderFactory = new LocaleFolderFactory;

        $this->setLocaleLoadersCollection();
    }

    /* =================================== */
    //             Interface
    /* =================================== */

    public function orderLoadingTranslations(LocalizationRepositoryContract $localization_repo): void
    {
        foreach ($this->localeLoadersCollection as $lang => $localeFolder) {
            $localeFolder->loadTranslations($localization_repo);
        }
    }

    /* =================================== */
    //          Setters
    /* =================================== */

    protected function setLocaleLoadersCollection(): void
    {
        $this->localeLoadersCollection = [];

        foreach ($this->directory->getDirectoryContent() as $lang => $abs_path) {
            $this->localeLoadersCollection[$lang] = $this->localeFolderFactory->make($abs_path);
        }
    }

    /* =================================== */
    //          Simple getters
    /* =================================== */

    /**
     * @return array<string>
     */
    public function getLocalesList(): array
    {
        return array_keys($this->directory->getDirectoryContent());
    }

    /**
     * @return array<LocaleFolderLoader>
     */
    public function getLocaleLoadersCollection(): array
    {
        return $this->localeLoadersCollection;
    }
}
