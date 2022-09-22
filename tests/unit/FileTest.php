<?php

use ElaborateCode\JsonTongue\Strategies\File;

it('gets correct project root path', function () {
    $root_folder = new File;

    $this->assertEquals($root_folder->getProjectRoot(), realpath(__DIR__.'/../../'));
});

it('gets correct tests folder path', function () {
    $this->assertEquals((string) new File('tests'), realpath(__DIR__.'/../'));

    $this->assertEquals((string) new File('/tests'), realpath(__DIR__.'/../'));

    // Can test '\test' on windows
    $this->assertEquals((new File(DIRECTORY_SEPARATOR.'tests'))->getPath(), realpath(__DIR__.'/../'));
});

it('throws an exception when relative path is invalid', function () {
    new File('i want some fruits');
})->throws(\Exception::class, "Invalid relative path. Can't get absolute path from 'i want some fruits'!");

it('scans directories', function () {
    $dir = new File();

    $this->assertContains(realpath(__DIR__.'/../../tests'), $dir->getDirectoryContent());
    $this->assertContains(realpath(__DIR__.'/../../vendor'), $dir->getDirectoryContent());
});

it('throws an exception for calling getDirectoryContent on a file', function () {
    $file = new File('composer.json');

    $file->getDirectoryContent();
})->throws(\Exception::class);
