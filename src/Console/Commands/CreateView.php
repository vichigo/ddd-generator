<?php

namespace Vichigo\DDDGenerator\Console\Commands;

use Illuminate\Console\GeneratorCommand;
use Illuminate\Support\Facades\File;

class CreateView extends GeneratorCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:view {view} {stub} {model}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Make laravel view blade file';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        $this->writeMarkdownTemplate();
        $this->info("View ".str_replace('.', '/', $this->argument('view')) . '.blade.php'." created.");
    }

    /**
     * Write the Markdown template for the mailable.
     *
     * @return void
     */
    protected function writeMarkdownTemplate()
    {
        $path = $this->viewPath($this->argument('view'));

        if (! $this->files->isDirectory(dirname($path))) {
            $this->files->makeDirectory(dirname($path), 0755, true);
        }

        if (File::exists($path)) {
            $this->error("View {$path} already exists!");
            return;
        }

        $message = str_replace('{{ model }}', $this->argument('model'), file_get_contents($this->getStub()));
        $message = str_replace('{{ modelLower }}', strtolower($this->argument('model')), $message);

        $this->files->put($path, $message);
    }


    /**
     * Get the view full path.
     *
     * @param string $path
     * @return string
     */
    protected function viewPath($path = ''): string
    {
        $view = str_replace('.', '/', $path) . '.blade.php';
        return "resources/views/{$view}";
    }

    /**
     * @inheritDoc
     */
    protected function getStub(): string
    {
        return __DIR__ . '/stubs/views/'.$this->argument('stub').'.stub';
    }
}
