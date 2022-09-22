<?php

use ElaborateCode\JsonTongue\Strategies\File;

it('gets correct project root path', function () {
    $root_folder = new File;

    expect($root_folder->getProjectRoot())
        ->toBe(realpath(__DIR__.'/../../'));
});

it('gets correct tests folder path', function () {
    expect((string) new File('tests'))
        ->toBe(realpath(__DIR__.'/../'));

    expect((string) new File('/tests'))
        ->toBe(realpath(__DIR__.'/../'));

    // Can test '\test' on windows
    expect((new File(DIRECTORY_SEPARATOR.'tests'))->getPath())
        ->toBe(realpath(__DIR__.'/../'));
});

it('throws an exception when relative path is invalid', function () {
    expect(fn () => new File('i want some fruits'))
        ->toThrow(\Exception::class, "Invalid relative path. Can't get absolute path from 'i want some fruits'!");
});

it('scans directories', function () {
    $dir = new File();

    expect($dir->getDirectoryContent())
        ->toContain(realpath(__DIR__.'/../../tests'));
    expect($dir->getDirectoryContent())
        ->toContain(realpath(__DIR__.'/../../vendor'));
});

it('throws an exception for calling getDirectoryContent on a file', function () {
    expect(fn () => (new File('composer.json'))->getDirectoryContent())
        ->toThrow(\Exception::class, 'This object isn\'t a directory');
});
