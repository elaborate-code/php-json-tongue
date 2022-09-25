<?php

uses()
    ->afterEach(function () {
        if (isset($this->jsonFaker)) {
            $this->jsonFaker->rollback();
        }
        unset($this->jsonFaker);
    })
    ->in('feature', 'unit');
