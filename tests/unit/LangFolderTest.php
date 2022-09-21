<?php

use ElaborateCode\JsonTongue\Composites\LangFolder;
use ElaborateCode\JsonTongue\Strategies\File;
use ElaborateCode\JsonTongue\Tests\JsonFaker\JsonFaker;

it('lists available locales correctly', function () {
    $faker = new JsonFaker([
        'ar' => [],
        'en' => [],
        'es' => [],
        'fr' => [],
    ]);

    $lang_folder = new LangFolder('/tests/temp/lang');

    $this->assertContains('ar', $lang_folder->getLocalesList());
    $this->assertContains('en', $lang_folder->getLocalesList());
    $this->assertContains('es', $lang_folder->getLocalesList());
    $this->assertContains('fr', $lang_folder->getLocalesList());

    $faker->rollback();
});

// it('traverses the right amount of locale folders', function () {
//     $lang_folder = new LangFolder(new File('/tests/lang'));

//     $locales_counter = 0;
//     foreach ($lang_folder as $json_name => $locale_folder) {
//         $locales_counter++;
//     }

//     $this->assertEquals(4, $locales_counter);
// });
