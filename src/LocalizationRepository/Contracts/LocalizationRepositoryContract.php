<?php

namespace ElaborateCode\JsonTongue\LocalizationRepository\Contracts;

interface LocalizationRepositoryContract
{
    public function merge(string $lang, array $translations): void;

    public function getTranslations(): array;
}
