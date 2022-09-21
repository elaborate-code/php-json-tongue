<?php

namespace ElaborateCode\JsonTongue\Tests\JsonFaker;

class JsonFaker
{
    protected string $langDirPath;

    protected bool $autoRollBack;

    public function __construct(array $compositions, bool $auto_roll_back = true)
    {
        $this->langDirPath = realpath(__DIR__ . './../') . '/temp/lang';

        $this->autoRollBack = $auto_roll_back;

        if (!mkdir($this->langDirPath, 0777, true)) {
            throw new \Exception('yo');
        }

        foreach ($compositions as $locale => $jsons_list) {
            if (!mkdir($this->langDirPath . "/$locale")) {
                throw new \Exception('zo');
            }

            foreach ($jsons_list as $json_name => $content) {
                file_put_contents($this->langDirPath . "/$locale/$json_name", json_encode($content));
            }
        }
    }

    public function __destruct()
    {
        if ($this->autoRollBack) {
            $this->delTree(dirname($this->langDirPath));
        }
    }

    public function rollback()
    {
        $this->delTree(dirname($this->langDirPath));
    }

    protected function delTree($dir): bool
    {
        if (!realpath($dir)) {
            return false;
        }

        $files = array_diff(scandir($dir), ['.', '..']);
        foreach ($files as $file) {
            (is_dir("$dir/$file")) ? $this->delTree("$dir/$file") : unlink("$dir/$file");
        }

        return rmdir($dir);
    }
}
