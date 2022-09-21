<?php

use ElaborateCode\JsonTongue\Composites\MultiLocaleFolder;
use ElaborateCode\JsonTongue\Factories\LocaleFolderFactory;
use ElaborateCode\JsonTongue\Strategies\File;

it('factory gives MultiLocaleFolder when folder is multi', function () {
    $factory = new LocaleFolderFactory;

    $multi_folder = new File('/tests/lang/multi');

    $multi = $factory->make($multi_folder);

    $this->assertInstanceOf(MultiLocaleFolder::class, $multi);
});
