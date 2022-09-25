<?php

namespace ElaborateCode\JsonTongue\Composites;

use ElaborateCode\JsonTongue\Contracts\LocaleJsonLoader;
use ElaborateCode\JsonTongue\Strategies\File;
use Exception;

final class LocaleJson implements LocaleJsonLoader
{
    protected File $json;

    protected array $content = [];

    public function __construct(string $abs_path)
    {
        if (! realpath($abs_path) || ! is_json($abs_path)) {
            throw new Exception("Invalid absolute JSON path $abs_path on LocaleJson instantiation");
        }

        // ! IOC
        $this->json = new File($abs_path);

        $this->setContent();
    }

    /**
     * Sets an empty array if file is:
     * - Decoded and Empty
     * - Cannot be decoded
     *
     * ? Throw an exception when sets empty
     */
    protected function setContent(): void
    {
        $this->content = json_decode(file_get_contents($this->json->getPath()), true) ?? [];
    }

    /* =================================== */
    //
    /* =================================== */

    /**
     * @return array<string>|array<array<string>>
     */
    public function getContent(): array
    {
        return $this->content;
    }

    /**
     * Helps testing
     *
     * TODO: support param like key/subkey/subsubkey/...
     */
    public function key(string $key): string|array
    {
        return $this->content[$key];
    }
}
