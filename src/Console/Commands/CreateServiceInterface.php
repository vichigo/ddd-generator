<?php

namespace Vichigo\DDDGenerator\Console\Commands;

use Illuminate\Console\GeneratorCommand;

class CreateServiceInterface extends GeneratorCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:serviceInterface {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command create service interface';

    protected function getStub()
    {
        return __DIR__ . '/stubs/serviceInterface.stub';
    }

    /**
     * Get the default namespace for the class.
     *
     * @param string $rootNamespace
     * @return string
     */
    protected function getDefaultNamespace($rootNamespace): string
    {
        return $rootNamespace . '\Interfaces';
    }
}
