<?php

uses()
    ->afterEach(function () {
        var_dump('executed');
        if (isset($this->jsonFaker)) {
            $this->jsonFaker->rollback();
        }
    })
    ->in('feature', 'unit');
