<?php

namespace Isu3ru\Cqrs\Tests\Stubs;

class ExampleCommand
{
    public $value;

    public function __construct($value = 'test_command')
    {
        $this->value = $value;
    }
}
