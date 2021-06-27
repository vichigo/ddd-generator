<?php

namespace Vichigo\DDDGenerator;

use Illuminate\Support\ServiceProvider;
use Vichigo\DDDGenerator\Console\Commands\CreateDataController;

class DDDGeneratorServiceProvider extends ServiceProvider
{
    public function register()
    {

    }

    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                CreateDataController::class,
            ]);
        }
    }


}
