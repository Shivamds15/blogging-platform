<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;

class MakeService extends Command
{
    protected $signature = 'make:service {name}';
    protected $description = 'Create a new service class';
    protected $files;

    public function __construct(Filesystem $files)
    {
        parent::__construct();
        $this->files = $files;
    }

    public function handle()
    {
        $name = $this->argument('name');
        $path = app_path("Services/{$name}.php");

        if ($this->files->exists($path)) {
            $this->error("Service class {$name} already exists!");
            return 1;
        }

        $this->files->put($path, $this->buildServiceClass($name));

        $this->info("Service class {$name} created successfully.");
        return 0;
    }

    protected function buildServiceClass($name)
    {
        return <<<EOD
        <?php

        namespace App\Services;
        use Illuminate\Support\Facades\Auth;

        class {$name}
        {
            // Add your service methods here
        }
        EOD;
    }
}
