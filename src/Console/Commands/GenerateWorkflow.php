<?php

namespace Vichigo\DDDGenerator\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class GenerateWorkflow extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'GenerateWorkflow';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Make you work faster';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $model_name = $this->ask('What is your model?');
        Artisan::call('CreateRequest', ['model' => "{$model_name}", 'action' => 'Create']);
        Artisan::call('make:customRequest', ['model' => "{$model_name}", 'action' => 'Update']);
        Artisan::call('make:model', ['name' => "$model_name"]);
        Artisan::call('make:customController', ['name' => "{$model_name}Controller", 'model' => "$model_name"]);
        Artisan::call('make:dataController', ['name' => "{$model_name}DataController", 'model' => "$model_name"]);
        Artisan::call('make:service', ['name' => "{$model_name}Service", 'model' => "{$model_name}"]);
        Artisan::call('make:serviceInterface', ['name' => "{$model_name}ServiceInterface"]);
        Artisan::call('make:view', ['view' => "admin.{$model_name}.create", 'stub' => 'create', 'model' => $model_name]);
        Artisan::call('make:view', ['view' => "admin.{$model_name}.edit", 'stub' => 'edit', 'model' => $model_name]);
        Artisan::call('make:view', ['view' => "admin.{$model_name}.partial", 'stub' => 'partial', 'model' => $model_name]);
        Artisan::call('make:view', ['view' => "admin.{$model_name}.index", 'stub' => 'index', 'model' => $model_name]);
        $this->info('Workflow generate successful!');
        return 0;
    }
}
