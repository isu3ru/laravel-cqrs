<?php

namespace Isu3ru\Cqrs\Tests\Unit;

use Isu3ru\Cqrs\Bus\CommandBus;
use Isu3ru\Cqrs\Tests\Stubs\ExampleCommand;
// No direct use of ExampleCommandHandler needed here anymore
use Isu3ru\Cqrs\Tests\Stubs\ExampleDependency;
use Isu3ru\Cqrs\Tests\Stubs\ResultService; // New
use Isu3ru\Cqrs\Tests\TestCase;

class CommandBusTest extends TestCase
{
    // getEnvironmentSetUp can be removed if not strictly necessary as CommandBus is manually instantiated
    // with namespaces. If CommandBus was resolved from container and used config, it would be needed.

    public function test_command_can_be_dispatched_to_handler()
    {
        $this->app->singleton(ResultService::class, function () {
            return new ResultService();
        });
        $this->app->bind(ExampleDependency::class, function () {
            return new ExampleDependency();
        });

        $commandBus = new CommandBus(
            $this->app,
            'Isu3ru\\Cqrs\\Tests\\Stubs', // Command Namespace (base for finding command)
            'Isu3ru\\Cqrs\\Tests\\Stubs'  // Handler Base Namespace (bus appends \Handlers\CmdNameHandler)
        );

        $command = new ExampleCommand('test_value');
        $commandBus->dispatch($command);

        $resultService = $this->app->make(ResultService::class);
        $this->assertEquals('test_value_dependency_value', $resultService->value);
    }

    public function test_handler_receives_dependencies_via_constructor()
    {
        $this->app->singleton(ResultService::class, function () {
            return new ResultService();
        });
        $this->app->bind(ExampleDependency::class, function () {
            $dependency = new ExampleDependency();
            $this->assertInstanceOf(ExampleDependency::class, $dependency); // Keep this check
            return $dependency;
        });
        
        $commandBus = new CommandBus(
            $this->app,
            'Isu3ru\\Cqrs\\Tests\\Stubs',
            'Isu3ru\\Cqrs\\Tests\\Stubs'
        );

        $command = new ExampleCommand('dependency_test');
        $commandBus->dispatch($command);
        
        $resultService = $this->app->make(ResultService::class);
        $this->assertEquals('dependency_test_dependency_value', $resultService->value);
    }
}
