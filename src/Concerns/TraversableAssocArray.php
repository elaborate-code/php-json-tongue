<?php

namespace ElaborateCode\JsonTongue\Concerns;

use ReturnTypeWillChange;

// * implements Iterator

trait TraversableAssocArray
{
    public string $traversableAssocPropertyName;

    public function rewind(): void
    {
        reset($this->{$this->traversableAssocPropertyName});
    }

    #[ReturnTypeWillChange]
    public function current()
    {
        return current($this->{$this->traversableAssocPropertyName});
    }

    #[ReturnTypeWillChange]
    public function key()
    {
        return key($this->{$this->traversableAssocPropertyName});
    }

    public function next(): void
    {
        next($this->{$this->traversableAssocPropertyName});
    }

    public function valid(): bool
    {
        return ! is_null(key($this->{$this->traversableAssocPropertyName}));
    }
}
