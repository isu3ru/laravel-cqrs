# Laravel CQRS

A proper CQRS utility library for Laravel. Originally from serrexlabs/laravel-cqrs

**Initiating Project**

`` php artisan init:project <project-name>``

**Module creation**

 `` php artisan make:module ``

 **Command creation**
 
 `` php artisan make:cqrs:command <command-name> ``
 
 * As a convention, append Command postfix end of every command (Ex: SampleCommand)
  
**Query creation**

`` php artisan make:cqrs:query <cquery-name> ``

* As a convention, append Query postfix end of every query (Ex: SampleQuery)

**Repository creation**

`` php artisan make:repository <repository-name> ``

* As a convention, append Repository postfix end of every repository (Ex: SampleRepository)

** Everything will be generated inside app/Cqrs directory. **


Change your controller to look like this.

```php
<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

use Isu3ru\Cqrs\Bus\CommandBus;
use Isu3ru\Cqrs\Bus\QueryExecutor;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * @var CommandBus
     */
    protected $command;

    /**
     * @var QueryExecutor
     */
    protected $query;

    /**
     * @param CommandBus $commandBus
     * @param QueryExecutor $executor
     */
    public function __construct(CommandBus $commandBus, QueryExecutor $executor)
    {
        $this->command = $commandBus;
        $this->query = $executor;
    }

}
```