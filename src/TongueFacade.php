<?php

namespace ElaborateCode\JsonTongue;

use ElaborateCode\JsonTongue\Composites\LangFolder;
use ElaborateCode\JsonTongue\Contracts\LangFolderLoader;

final class TongueFacade
{
    protected LangFolderLoader $langLoader;

    protected LocalizationRepository $localizationRepo;

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
}
