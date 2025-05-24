# Laravel CQRS

CQRS utility library for Laravel. Code adopted form the outdated repository serrexlabs/laravel-cqrs.

## Compatibility

This library is compatible with **Laravel 11.x** and requires **PHP 8.2** or higher.
Core Laravel dependencies have been updated to match Laravel 11.x requirements.

## Installation

add to composer.json file as a repository.

``
    "repositories": [
        {
            "type": "vcs",
            "url": "https://github.com/isu3ru/laravel-cqrs"
        }
    ],
``

then require in composer as ``"isu3ru/laravel-cqrs": "dev-master"`` (or the appropriate version tag for Laravel 11 compatibility). Then run ``composer update`` to install the project.

## Testing

The package now includes automated tests managed by PHPUnit and Orchestra Testbench to ensure stability and easier development. You can run tests using the `composer test` script.

## How to add into your Laravel Project

Change your ``app/Http/Controllers/Controller.php`` to look like this.

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

## Artisan Commands

**Initiating Project**

`` php artisan init:project <project-name>``

**Module Creation**

 `` php artisan make:module <module-name>``

 **Command Creation**
 
 `` php artisan make:cqrs:command <command-name> ``
 
 * As a convention, append **Command** to the command name (Ex: SampleCommand)
  
**Query Creation**

`` php artisan make:cqrs:query <cquery-name> ``

* As a convention, append **Query** to the query name (Ex: SampleQuery)

**Repository Creation**

`` php artisan make:repository <repository-name> ``

* As a convention, append **Repository** to the repository name (Ex: SampleRepository)

** Everything will be generated inside **app/Cqrs** directory. **

**Transformer Creation**

`` php artisan make:transformer <transformer-name> ``


## Issues and Pull Requests are welcome from everybody.


