<?php

namespace  Isu3ru\Cqrs\Console\Commands;

class ExceptionMakeCommand extends RootGeneratorCommand
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $signature = 'make:cqrs:exception {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new cqrs exception';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'Exception';

    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub()
    {
        return __DIR__ . '/stubs/exception.stub';
    }


    protected function getEntityNamespace()
    {
        return  '\Exception';
    }
}
