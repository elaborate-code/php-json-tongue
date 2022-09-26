<?php

namespace ElaborateCode\JsonTongue\LocaleFolder\Abstracts;

use ElaborateCode\JsonTongue\LocaleJson\LocaleJson;
use ElaborateCode\JsonTongue\LocalizationRepository\Contracts\LocalizationRepositoryContract;
use ElaborateCode\JsonTongue\Strategies\File;
use Exception;

abstract class LocaleFolderLoader
{
    protected File $directory;

    protected string $lang;

    /**
     * @var array<LocaleJsonLoader>
     */
    protected array $localeJsonLoadersCollection;

    public function __construct(string $abs_path)
    {
        if (! realpath($abs_path) || ! is_dir($abs_path)) {
            throw new Exception("Invalid absolute folder path $abs_path on LocaleFolder instantiation");
        }

        // ! IOC
        $this->directory = new File($abs_path);

        $this->setLangFromPath();

        $this->setJsonLoadersCollection();
    }

    /* =================================== */
    //          Interface
    /* =================================== */

    abstract public function loadTranslations(LocalizationRepositoryContract $localization_repo): void;

    /* =================================== */
    //          Setters
    /* =================================== */

    protected function setLangFromPath(): void
    {
        $this->lang = basename($this->directory->getPath());
    }

    protected function setJsonLoadersCollection(): void
    {
        $this->localeJsonLoadersCollection = [];

        foreach ($this->directory->getDirectoryJsonContent() as $file_name => $abs_path) {
            // ! IOC
            $this->localeJsonLoadersCollection[$file_name] = new LocaleJson($abs_path);
        }
    }

    /* =================================== */
    //          Simple getters
    /* =================================== */

    public function getLang(): string
    {
        return $this->lang;
    }

    /**
     * @return array<string> 'JSON_name' => 'file_absolute_path'
     */
    public function getJsonsList(): array
    {
        return $this->directory->getDirectoryJsonContent();
    }

    /**
     * @return array<LocaleJsonLoader> 'JSON_name' => 'LocaleJsonLoader'
     */
    public function getLocaleJsonLoadersCollection(): array
    {
        return $this->localeJsonLoadersCollection;
    }
}
