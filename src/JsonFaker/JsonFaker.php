<?php

namespace ElaborateCode\JsonTongue\JsonFaker;

use ElaborateCode\JsonTongue\JsonFaker\Contracts\JsonFakerContract;
use ElaborateCode\JsonTongue\Strategies\File;
use Exception;

class JsonFaker implements JsonFakerContract
{
    protected array $compositions = [];

    protected string $testingPath;

    protected string $baseTestingPath;

    public function __construct(
        protected bool $autoRollBack = true,
        protected string $tempTestingPath = '/temp/lang',
        string $base_testing_path = '/tests',
    ) {
        // TODO: tempTestingPath cannot be empty
        // TODO: baseTestingPath must be a dir

        $this->baseTestingPath = new File($base_testing_path);

        $this->testingPath = $this->baseTestingPath.DIRECTORY_SEPARATOR.$this->tempTestingPath;

        if (! mkdir($this->testingPath, 0777, true)) {
            throw new Exception("Could not create a temporary directory /tests/{$this->tempTestingPath}");
        }
    }

    /* =================================== */
    //      Chainables
    /* =================================== */

    public static function make(
        bool $autoRollBack = true,
        string $tempTestingPath = '/temp/lang',
        string $base_testing_path = '/tests',
    ): static {
        return new static($autoRollBack, $tempTestingPath, $base_testing_path);
    }

    public static function makeAndWriteLocals(
        array $compositions,
        bool $autoRollBack = true,
        string $tempTestingPath = '/temp/lang',
        string $base_testing_path = '/tests',
    ): static {
        $static = new static($autoRollBack, $tempTestingPath, $base_testing_path);

        foreach ($compositions as $lang => $jsons) {
            $static->addLocale($lang, $jsons);
        }

        return $static;
    }

    public function addLocale(string $lang, array $jsons): static
    {
        $this->compositions[$lang] = $jsons;

        return $this;
    }

    public function write(): static
    {
        foreach ($this->compositions as $locale => $jsons_list) {
            if (! mkdir($this->testingPath."/$locale")) {
                throw new Exception('zo');
            }

            foreach ($jsons_list as $json_name => $content) {
                file_put_contents($this->testingPath."/$locale/$json_name", json_encode($content));
            }
        }

        return $this;
    }

    public function flush(): static
    {
        $this->compositions = [];

        return $this;
    }

    /* =================================== */
    //          Simple getters
    /* =================================== */

    public function getPath(): string
    {
        return $this->testingPath;
    }

    /* =================================== */
    //
    /* =================================== */

    public function rollback(): void
    {
        $temp_root = explode('/', trim($this->tempTestingPath, '/'))[0] ?? '';

        $target = $this->baseTestingPath.DIRECTORY_SEPARATOR.$temp_root;

        if (! realpath($target)) {
            throw new Exception("Trying a manual rollback with {$target} does not exist");
        }

        rm_tree($target);
    }
}
