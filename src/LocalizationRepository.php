<?php

namespace ElaborateCode\JsonTongue;

final class LocalizationRepository
{
    protected array $translations = [];

    public function merge(string $lang, array $translations): void
    {
        if (isset($this->translations[$lang])) {
            $this->translations[$lang] = $this->translations[$lang] + $translations;
        } else {
            $this->translations[$lang] = $translations;
        }
    }

    /**
     * @return array<array<string>>
     */
    public function getTranslations(): array
    {
        // TODO: return a reference ?
        return $this->translations;
    }
}
