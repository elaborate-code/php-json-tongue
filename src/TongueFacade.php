<?php

namespace ElaborateCode\JsonTongue;

use ElaborateCode\JsonTongue\LangFolder\Contracts\LangFolderLoader;
use ElaborateCode\JsonTongue\LangFolder\LangFolder;
use ElaborateCode\JsonTongue\LocalizationRepository\Contracts\LocalizationRepositoryContract;
use ElaborateCode\JsonTongue\LocalizationRepository\LocalizationRepository;

final class TongueFacade
{
    protected LangFolderLoader $langLoader;

    protected LocalizationRepositoryContract $localizationRepo;

    public function __construct(string $path = '/lang')
    {
        // ! IOC
        $this->langLoader = new LangFolder($path);

        // ! IOC
        $this->localizationRepo = new LocalizationRepository;

        $this->learn();
    }

    protected function learn(): void
    {
        $this->langLoader->orderLoadingTranslations($this->localizationRepo);
    }

    /**
     * @return array<array<string>>
     */
    public function transcribe(): array
    {
        return $this->localizationRepo->getTranslations();
    }

    /**
     * @return array<string>
     */
    public function transcribeLang(string $lang): array
    {
        // TODO: throw exceptio if lang not found ?
        return $this->localizationRepo->getTranslations()[$lang];
    }
}
