<?php

namespace Isu3ru\Cqrs;

use Illuminate\Support\ServiceProvider as BaseServiceProvider;
use Isu3ru\Cqrs\Console\Commands\CommandHandlerMakeCommand;
use Isu3ru\Cqrs\Console\Commands\CommandMakeCommand;
use Isu3ru\Cqrs\Console\Commands\InitProjectCommand;
use Isu3ru\Cqrs\Console\Commands\ModuleMakeCommand;
use Isu3ru\Cqrs\Console\Commands\QueryHandlerMakeCommand;
use Isu3ru\Cqrs\Console\Commands\QueryMakeCommand;
use Isu3ru\Cqrs\Console\Commands\RepositoryInterfaceMakeCommand;
use Isu3ru\Cqrs\Console\Commands\RepositoryMakeCommand;
use Isu3ru\Cqrs\Console\Commands\TransformerMakeCommand;
use Isu3ru\Cqrs\Console\Commands\ExceptionMakeCommand;
use Isu3ru\Cqrs\Bus\CommandBus;
use Isu3ru\Cqrs\Bus\QueryExecutor;

class ServiceProvider extends BaseServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                InitProjectCommand::class,
                ModuleMakeCommand::class,
                CommandMakeCommand::class,
                CommandHandlerMakeCommand::class,
                QueryMakeCommand::class,
                QueryHandlerMakeCommand::class,
                RepositoryMakeCommand::class,
                RepositoryInterfaceMakeCommand::class,
                TransformerMakeCommand::class,
                ExceptionMakeCommand::class,
            ]);
        }
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $commandNamespace = "Command";
        $commandHandlerNamespace = "Command\Handlers";

        $this->app->singleton(CommandBus::class, function ($app) use ($commandNamespace, $commandHandlerNamespace){
            return new CommandBus($app, $commandNamespace, $commandHandlerNamespace);
        });

        $queryNamespace = "Query";
        $queryHandlerNamespace = "Query\Handlers";

        $this->app->singleton(QueryExecutor::class, function ($app) use ($queryNamespace, $queryHandlerNamespace){
            return new QueryExecutor($app, $queryNamespace, $queryHandlerNamespace);
        });
    }
}
