<?php

/**
 * @param  string  $path relative/absolute file path, or file name
 * @return bool True if path ends with '.json'
 */
function is_json(string $path): bool
{
    return strcmp(strtolower(substr($path, -5)), '.json') === 0;
}

function rm_tree($dir): bool
{
    $files = array_diff(scandir($dir), ['.', '..']);
    foreach ($files as $file) {
        (is_dir("$dir/$file")) ? rm_tree("$dir/$file") : unlink("$dir/$file");
    }

    return rmdir($dir);
}
