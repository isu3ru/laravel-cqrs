<?php

namespace Isu3ru\Cqrs\Tests\Unit;

use Isu3ru\Cqrs\Bus\QueryExecutor;
use Isu3ru\Cqrs\Tests\Stubs\ExampleDependency;
use Isu3ru\Cqrs\Tests\Stubs\ExampleQuery;
use Isu3ru\Cqrs\Tests\Stubs\ExampleQueryHandler; // Ensure this use statement is correct if used directly
use Isu3ru\Cqrs\Tests\TestCase;

class QueryExecutorTest extends TestCase
{
    // getEnvironmentSetUp can be removed if not strictly necessary

    public function test_query_can_be_executed_and_returns_data()
    {
        $this->app->bind(ExampleDependency::class, function () {
            return new ExampleDependency();
        });

        $queryExecutor = new QueryExecutor(
            $this->app,
            'Isu3ru\\Cqrs\\Tests\\Stubs',
            'Isu3ru\\Cqrs\\Tests\\Stubs'
        );

        $query = new ExampleQuery(123);
        $this->assertEquals(123, $query->id); // Added pre-dispatch assertion

        $result = $queryExecutor->execute($query);

        $this->assertIsArray($result);
        $this->assertEquals([
            'id' => 123, // Expecting 123
            'data' => 'query_result',
            'dependency_value' => 'dependency_value',
        ], $result);
    }

    public function test_query_handler_receives_dependencies_via_constructor()
    {
        $this->app->bind(ExampleDependency::class, function () {
            $dependency = new ExampleDependency();
            $this->assertInstanceOf(ExampleDependency::class, $dependency);
            return $dependency;
        });

        $queryExecutor = new QueryExecutor(
            $this->app,
            'Isu3ru\\Cqrs\\Tests\\Stubs',
            'Isu3ru\\Cqrs\\Tests\\Stubs'
        );
        
        $query = new ExampleQuery(456);
        $this->assertEquals(456, $query->id); // Added pre-dispatch assertion
        
        $result = $queryExecutor->execute($query);

        $this->assertIsArray($result);
        $this->assertEquals([
            'id' => 456, // Expecting 456
            'data' => 'query_result',
            'dependency_value' => 'dependency_value',
        ], $result);
    }
}
