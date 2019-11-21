<?php

namespace Cirlmcesc\LaravelMddoc;

use Illuminate\Console\Command;

class InstallCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mddoc:install';
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Run the commands necessary to prepare Mddoc for use';
    /**
     * Execute the console command.
     *
     * @author moell<moel91@foxmail.com>
     * @return mixed
     */
    public function handle()
    {
        $this->call('vendor:publish', [
            "--tag" => "mddoc-config",
            "--force",
        ]);

        $this->call('vendor:publish', [
            "--tag" => "mddoc-resources",
            "--force",
        ]);
    }
}
