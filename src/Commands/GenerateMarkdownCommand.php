<?php

namespace Cirlmcesc\LaravelMddoc\Commands;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use Cirlmcesc\LaravelMddoc\LaravelMddoc;

class GenerateMarkdownCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:documentation
                            {path : The file storage path}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new markdown template file to path';

    /**
     * Template file path variable.
     *
     * @var string
     */
    public $template_file_path;

    /**
     * LaravelMddoc class variable.
     *
     * @var \Cirlmcesc\LaravelMddoc\LaravelMddoc
     */
    public $mddoc;

    /**
     * File operation class instance variable.
     *
     * @var Symfony\Component\Filesystem\Filesystem
     */
    public $filesystem;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();

        $this->template_file_path = __DIR__ . "/template.md";

        $this->filesystem = new Filesystem();

        $this->mddoc = new LaravelMddoc();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $pathinput = $this->getPathInput();

        if ((!$this->hasOption('force') ||
            !$this->option('force')) &&
            $this->alreadyExists($pathinput)) {
            $this->error('Markdown file already exists !');

            return false;
        }

        $this->makeDirectory($pathinput);

        $this->filesystem->copy(
            $this->template_file_path,
            $this->mddoc->current_files_path . (str_start($pathinput, "/")) . ".md"
        );

        $this->info('Markdown file created successfully.');
    }

    /**
     * Build the directory for the class if necessary.
     *
     * @param  string  $path
     * @return string
     */
    private function makeDirectory($path)
    {
        $path = $this->mddoc->current_files_path . str_start($path, "/");

        if (!$this->filesystem->isDirectory(dirname($path))) {
            $this->filesystem->makeDirectory(dirname($path), 0777, true, true);
        }

        return $path;
    }

    /**
     * Get the desired class name from the input.
     *
     * @return string
     */
    private function getPathInput(): String
    {
        return trim($this->argument('path'));
    }

    /**
     * Determine if the class already exists.
     *
     * @param  string  $filepath
     * @return bool
     */
    private function alreadyExists($filepath)
    {
        return $this->filesystem->exists(
            $this->mddoc->current_files_path . str_start($filepath, "/") . ".md");
    }
}
