<?php

namespace Isu3ru\Cqrs\Tests\Stubs\Handlers; // <-- Updated namespace

use Isu3ru\Cqrs\Tests\Stubs\ExampleDependency;
use Isu3ru\Cqrs\Tests\Stubs\ExampleQuery;

class ExampleQueryHandler
{
    private $dependency;

    public function __construct(ExampleDependency $dependency)
    {
        $this->dependency = $dependency;
    }

    public function __invoke(ExampleQuery $query)
    {
        return [
            'id' => $query->id,
            'data' => 'query_result',
            'dependency_value' => $this->dependency->getValue(),
        ];
    }
}
