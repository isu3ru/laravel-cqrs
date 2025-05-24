<?php

namespace Isu3ru\Cqrs\Tests\Stubs;

class ExampleQuery
{
    public $id;

    public function __construct($id = 1)
    {
        $this->id = $id;
    }
}
