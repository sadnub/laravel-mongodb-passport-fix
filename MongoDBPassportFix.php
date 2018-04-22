<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class MongoDBPassportFix extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'fix:passport
                            {--rollback : Rollback the Passport fix}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fixes passport for MongoDB support';

    /**
     * MongoDB Model to use
     *
     * @var string
     */
    protected $mongo_model = 'Jenssegers\Mongodb\Eloquent\Model';

    /**
     * Laravel Eloquent Model to Replace with
     *
     * @var string
     */
    protected $laravel_model = 'Illuminate\Database\Eloquent\Model';

    /**
     * Passport vendor files location
     *
     * @var string
     */
    protected $passport_path = 'vendor/laravel/passport/src/';

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
     * @return mixed
     */
    public function handle()
    {
        //
        if (!$this->option('rollback'))
        {
          	$this->fixFiles();
          	$this->info("Passport Files have been fixed for MongoDB");
        } else {
          
            $this->rollbackFiles();
            $this->info("Passport Files have been rolled back for MongoDB");
        }
    }
    
    /**
     * Searches and fixes the passport files
     *
     * @return void
     */
    protected function fixFiles()
    {

    	foreach (glob(base_path($this->passport_path) . '*.php') as $filename)
    	{
    	    $file = file_get_contents($filename);
    	    file_put_contents($filename, str_replace($this->laravel_model, $this->mongo_model, $file));
    	    //$this->info($filename . " has been Checked/Modified");
    	}

    }
    
    protected function rollbackFiles()
    {

    	foreach (glob(base_path($this->passport_path) . '*.php') as $filename)
    	{
    	    $file = file_get_contents($filename);
    	    file_put_contents($filename, str_replace($this->mongo_model, $this->laravel_model, $file));
    	    //$this->info($filename . " has been Checked/Modified");
    	}

    }
}
