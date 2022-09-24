<?php

use ElaborateCode\JsonTongue\Strategies\File;

test('getProjectRoot')
    ->expect((new File)->getProjectRoot())
    ->toBe(realpath(__DIR__.'/../../'));

it('constructs with project root path by default')
    ->expect((new File)->getPath())
    ->toBe(realpath(__DIR__.'/../../'));

it('constructs with given valid absolute paths')
    ->expect([
        new File(__DIR__),
        new File(__FILE__),
    ])
    ->each
    ->toBeInstanceOf(File::class);

it('constructs with given valid relative paths')
    ->expect([
        new File('.'),
        new File('/'),
        new File('./'),
        new File('..'),
        new File('/..'),
        new File('./..'),
        new File('tests'),
        new File('/tests'),
        new File('./tests'),
        new File('/composer.json'),
        new File('./composer.json'),
    ])
    ->each
    ->toBeInstanceOf(File::class);

it('throws an exception when constructing with an invalid $rel_path')
    ->expect(fn () => new File('i want some fruits'))
    ->throws(\Exception::class, "Invalid relative path. Can't get absolute path from 'i want some fruits'!");

test('getPath & __toString')
    ->expect([
        (new File('tests'))->getPath(),
        (string) new File('/tests'),
        (string) new File(DIRECTORY_SEPARATOR.'tests'),
        // Can test '\test' on windows
    ])
    ->each
    ->toBe(realpath(__DIR__.'/..'));

test('isDir')
    ->expect((new File(__DIR__))->isDir())
    ->toBeTrue()
    ->and((new File(__FILE__))->isDir())
    ->toBeFalse();

test('getDirectoryContent')
    ->expect((new File())->getDirectoryContent())
    ->toContain(realpath(__DIR__.'/../../composer.json'))
    ->toContain(realpath(__DIR__.'/../../src'))
    ->toContain(realpath(__DIR__.'/../../tests'))
    ->toContain(realpath(__DIR__.'/../../vendor'));

it('throws an exception for calling getDirectoryContent on a file')
    ->expect(fn () => (new File('composer.json'))->getDirectoryContent())
    ->throws(\Exception::class, 'This object isn\'t a directory');

test('getDirectoryJsonContent')
    ->expect((new File())->getDirectoryJsonContent())
    ->toHaveCount(1)
    ->toContain(realpath(__DIR__.'/../../composer.json'));

it('throws an exception for calling getDirectoryJsonContent on a file')
    ->expect(fn () => (new File('composer.json'))->getDirectoryJsonContent())
    ->throws(\Exception::class, 'This object isn\'t a directory');
