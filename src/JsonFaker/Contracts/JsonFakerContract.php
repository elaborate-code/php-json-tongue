<?php

namespace ElaborateCode\JsonTongue\JsonFaker\Contracts;

interface JsonFakerContract
{
    public function __construct(
        bool $auto_roll_back = true,
        string $temp_path = '/temp/lang'
    );
}
