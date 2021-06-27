<?php

namespace Vichigo\DDDGenerator\Console\Commands;

use Illuminate\Console\GeneratorCommand;
use Illuminate\Support\Facades\File;

class CreateRequest extends GeneratorCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'CreateRequest {model} {action}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Make laravel custom request';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        $this->writeMarkdownTemplate();
    }

    /**
     * Write the Markdown template for the mailable.
     *
     * @return void
     */
    protected function writeMarkdownTemplate()
    {
        $action = $this->argument('action');
        $model = $this->argument('model');
        $path =  "app/Http/Requests/Admin/{$action}{$model}Request.php";

        if (! $this->files->isDirectory(dirname($path))) {
            $this->files->makeDirectory(dirname($path), 0755, true);
        }

        if (File::exists($path)) {
            $this->error("Request {$path} already exists!");
            return;
        }

        $message = str_replace('{{ model }}', $model, file_get_contents($this->getStub()));
        $message = str_replace('{{ action }}', $action, $message);

        $this->files->put($path, $message);
    }

    /**
     * @inheritDoc
     */
    protected function getStub(): string
    {
        return __DIR__ . '/stubs/request.stub';
    }
}
