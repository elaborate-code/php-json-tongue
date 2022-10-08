<?php

namespace ElaborateCode\JsonTongue\Strategies;

use Exception;
use Stringable;

final class File implements Stringable
{
    /**
     * Realpath
     */
    protected string $projectRoot;

    /**
     * Realpath
     */
    protected string $path;

    protected bool $isDir;

    /**
     * 'file_name' => 'file_absolute_path'
     */
    protected array $directoryContent;

    /**
     * @param  string  $path an absolute path or a path starting from the project root
     */
    public function __construct(string $path = '')
    {
        $this->setProjectRoot();

        $this->setPath($path);

        $this->isDir = is_dir($this->path);

        if ($this->isDir()) {
            $files = scandir($this->path);
            $files = array_splice($files, 2);

            $this->directoryContent = [];

            foreach ($files as $file_name) {
                $this->directoryContent[$file_name] = realpath($this->path.DIRECTORY_SEPARATOR.$file_name);
            }
        }
    }

    public function __toString(): string
    {
        return $this->path;
    }

    /* =================================== */
    //
    /* =================================== */

    protected function setProjectRoot(): void
    {
        $reflection = new \ReflectionClass(\Composer\Autoload\ClassLoader::class);

        $this->projectRoot = realpath(dirname($reflection->getFileName(), 3));
    }

    protected function setPath(string $path): void
    {
        $is_valid_abs_path = realpath($path);

        if ($is_valid_abs_path) {
            $this->path = $is_valid_abs_path;

            return;
        }

        $realpath = realpath($this->getProjectRoot().DIRECTORY_SEPARATOR.$path);

        if (! $realpath) {
            throw new Exception("Invalid relative path. Can't get absolute path from '$path'!");
        }

        $this->path = $realpath;
    }

    /* =================================== */
    //
    /* =================================== */

    /**
     * 'File_name' => 'file_absolute_path'
     */
    public function getDirectoryContent(): array
    {
        if (! $this->isDir()) {
            throw new Exception('This object isn\'t a directory');
        }

        return $this->directoryContent;
    }

    /**
     * 'Dir_name/locale' => 'dir_absolute_path'
     */
    public function getSubDirectories(): array
    {
        $directoryContent = $this->getDirectoryContent();

        return array_filter(
            $directoryContent,
            fn ($abs_path) => is_dir($abs_path),
            ARRAY_FILTER_USE_BOTH
        );
    }

    /**
     * 'JSON_name' => 'file_absolute_path'
     */
    public function getDirectoryJsonContent(): array
    {
        $directoryContent = $this->getDirectoryContent();

        return array_filter(
            $directoryContent,
            fn ($abs_path, $file_name) => is_json($file_name),
            ARRAY_FILTER_USE_BOTH
        );
    }

    /* =================================== */
    //          Simple getters
    /* =================================== */

    public function isDir(): bool
    {
        return $this->isDir;
    }

    public function getProjectRoot(): string
    {
        return $this->projectRoot;
    }

    public function getPath(): string
    {
        return $this->path;
    }
}
