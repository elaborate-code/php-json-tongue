<?php

namespace ElaborateCode\JsonTongue\Contracts;

interface JsonFakerContract
{
    public function __construct(
        bool $auto_roll_back = true,
        string $temp_path = '/temp/lang'
    );
}
