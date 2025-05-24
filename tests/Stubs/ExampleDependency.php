<?php

namespace Isu3ru\Cqrs\Tests\Stubs;

class ExampleDependency
{
    public function getValue(): string
    {
        return 'dependency_value';
    }
}
