<?php

namespace ElaborateCode\JigsawLocalization;

use ElaborateCode\JigsawLocalization\Composites\LangFolder;

class LoadLocalization
{
    protected LangFolder $langLoader;

    protected LocalizationRepository $localizationRepo;

    public function __construct(string $path = '/lang')
    {
        // ! IOC
        $this->langLoader = new LangFolder($path);

        // ! IOC
        $this->localizationRepo = new LocalizationRepository;
    }

    public function learn(): void
    {
        $this->langLoader->orderLoadingTranslations($this->localizationRepo);
    }

    public function speak(): array
    {
        return $this->localizationRepo->getTranslations();
    }
}
