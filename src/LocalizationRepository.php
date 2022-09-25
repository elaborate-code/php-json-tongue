<?php

namespace ElaborateCode\JsonTongue;

use ElaborateCode\JsonTongue\Contracts\LocalizationRepositoryContract;

final class LocalizationRepository implements LocalizationRepositoryContract
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
