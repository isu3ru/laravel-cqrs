# Laravel CQRS

CQRS utility library for Laravel. Code adopted form serrexlabs/laravel-cqrs.

# installation

add to composer.json file as a repository.

``
    "repositories": [
        {
            "type": "vcs",
            "url": "https://github.com/isu3ru/laravel-cqrs"
        }
    ],
``

then require in composer as ``"isu3ru/laravel-cqrs": "dev-master"``. then run composer update to install the project.

## Updated to Laravel 6.4. 

**Initiating Project**

`` php artisan init:project <project-name>``

**Module Creation**

 `` php artisan make:module <module-name>``

 **Command Creation**
 
 `` php artisan make:cqrs:command <command-name> ``
 
 * As a convention, append Command postfix end of every command (Ex: SampleCommand)
  
**Query Creation**

`` php artisan make:cqrs:query <cquery-name> ``

* As a convention, append Query postfix end of every query (Ex: SampleQuery)

**Repository Creation**

`` php artisan make:repository <repository-name> ``

* As a convention, append Repository postfix end of every repository (Ex: SampleRepository)

** Everything CQRS related components will be generated inside app/Cqrs directory. **

**Transformer Creation**

`` php artisan make:transformer <transformer-name> ``

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