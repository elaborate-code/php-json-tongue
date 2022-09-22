<?php

uses()
    ->afterEach(function () {
        if (isset($this->jsonFaker)) {
            $this->jsonFaker->rollback();
        }
    })
    ->in('Feature', 'Unit');
