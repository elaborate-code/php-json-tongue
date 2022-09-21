<?php

use ElaborateCode\JsonTongue\Composites\LocaleFolder;
use ElaborateCode\JsonTongue\Factories\LocaleFolderFactory;
use ElaborateCode\JsonTongue\Strategies\File;
use ElaborateCode\JsonTongue\Tests\JsonFaker\JsonFaker;

it('sets locale lang correctly', function () {
    $faker = new JsonFaker([
        'en' => [],
    ]);

    $factory = new LocaleFolderFactory;

    $en = new File('/tests/temp/lang/en');

    $locale = $factory->make($en);

    $this->assertEquals($locale->getLang(), 'en');

    // $this->assertFalse($locale->isMulti()); // test instance
});

it('assert JsonsList', function () {
    $faker = new JsonFaker([
        'en' => [
            'en.json' => [],
        ],
    ]);

    $factory = new LocaleFolderFactory;

    $en = new File('/tests/temp/lang/en');

    $locale = $factory->make($en);

    $this->assertArrayHasKey('en.json', $locale->getJsonsList());
});

// it('traverses the right amount of locale JSONs', function () {
//     $lang_folder = new LocaleFolder(new File('/tests/lang/en'));

//     $jsons_counter = 0;
//     foreach ($lang_folder as $json_name => $locale_folder) {
//         $jsons_counter++;
//     }

//     $this->assertEquals(3, $jsons_counter);
// });
