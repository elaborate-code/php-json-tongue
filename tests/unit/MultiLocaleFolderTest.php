<?php

use ElaborateCode\JsonTongue\Composites\MultiLocaleFolder;
use ElaborateCode\JsonTongue\Factories\LocaleFolderFactory;
use ElaborateCode\JsonTongue\Strategies\File;
use ElaborateCode\JsonTongue\Tests\JsonFaker\JsonFaker;

it('factory gives MultiLocaleFolder when folder is multi', function () {
    $faker = new JsonFaker([
        'multi' => [
            'greetings.json' => [
                'en' => [
                    'Hello' => 'Hello',
                ],
                'fr' => [
                    'Hello' => 'Salut',
                ],
            ],
        ],
    ]);

    $factory = new LocaleFolderFactory;

    $multi_folder = new File('/tests/temp/lang/multi');

    $multi = $factory->make($multi_folder);

    $this->assertInstanceOf(MultiLocaleFolder::class, $multi);
});
