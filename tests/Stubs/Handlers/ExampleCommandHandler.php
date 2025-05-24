<?php

namespace Isu3ru\Cqrs\Tests\Stubs\Handlers;

use Isu3ru\Cqrs\Tests\Stubs\ExampleCommand;
use Isu3ru\Cqrs\Tests\Stubs\ExampleDependency;
use Isu3ru\Cqrs\Tests\Stubs\ResultService; // New

class ExampleCommandHandler
{
    private $dependency;
    private $resultService; // New

    public function __construct(ExampleDependency $dependency, ResultService $resultService) // Updated
    {
        $this->dependency = $dependency;
        $this->resultService = $resultService; // New
    }

    public function __invoke(ExampleCommand $command)
    {
        $this->resultService->value = $command->value . '_' . $this->dependency->getValue(); // Updated
    }
}
