<?php

namespace ElaborateCode\JsonTongue\Contracts;

interface LocalizationRepository
{
    public function merge(string $lang, array $translations): void;

    public function getTranslations(): array;
}
