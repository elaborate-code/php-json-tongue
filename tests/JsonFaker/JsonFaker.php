<?php

namespace ElaborateCode\JsonTongue\Tests\JsonFaker;

use ElaborateCode\JsonTongue\Strategies\File;
use Exception;

class JsonFaker
{
    protected string $langDirPath;

    protected bool $autoRollBack;

    protected array $compositions = [];

    public function __construct(
        protected bool $auto_roll_back = true,
        string $temp_path = '/temp/lang'
    ) {
        $tests_dir = new File('/tests');

        $this->langDirPath = $tests_dir.DIRECTORY_SEPARATOR.$temp_path;

        if (! mkdir($this->langDirPath, 0777, true)) {
            throw new Exception("Could not create a temporary directory /tests/$temp_path");
        }
    }

    public function rollback(): void
    {
        if (! realpath($this->langDirPath)) {
            throw new Exception("Trying a manual rollback with {$this->langDirPath} does not exist");
        }

        $this->delTree(dirname($this->langDirPath));
    }

    /* =================================== */
    //      Chainables
    /* =================================== */

    public static function make(bool $auto_roll_back = true, string $temp_path = '/temp/lang'): static
    {
        return new static($auto_roll_back, $temp_path);
    }

    public static function makeAndWriteLocals(array $compositions, bool $auto_roll_back = true, string $temp_path = '/temp/lang'): static
    {
        $static = new static($auto_roll_back, $temp_path);

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
            if (! mkdir($this->langDirPath."/$locale")) {
                throw new Exception('zo');
            }

            foreach ($jsons_list as $json_name => $content) {
                file_put_contents($this->langDirPath."/$locale/$json_name", json_encode($content));
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
    //
    /* =================================== */

    protected function delTree($dir): bool
    {
        $files = array_diff(scandir($dir), ['.', '..']);
        foreach ($files as $file) {
            (is_dir("$dir/$file")) ? $this->delTree("$dir/$file") : unlink("$dir/$file");
        }

        return rmdir($dir);
    }
}
