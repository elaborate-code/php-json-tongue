<?php

use ElaborateCode\JsonTongue\TongueFacade;

it('complete', function () {
    $tongue = new TongueFacade('/tests/lang');

    $this->assertCount(3, $tongue->transcribe());
    $this->assertArrayHasKey('ar', $tongue->transcribe());
    $this->assertArrayHasKey('en', $tongue->transcribe());
    $this->assertArrayHasKey('fr', $tongue->transcribe());

    $this->assertCount(0, $tongue->transcribe()['ar']);
    $this->assertCount(5, $tongue->transcribe()['en']);
});
