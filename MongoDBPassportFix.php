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
    protected $signature = 'fix:passport';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fixes passport for MongoDB support';

    /**
     * MongoDB Model to use
     *
     * @return void
     */
    protected $mongo_model = 'Jenssegers\Mongodb\Eloquent\Model';

    /**
     * Laravel Eloquent Model to Replace with
     *
     * @return void
     */
    protected $laravel_model = 'Illuminate\Database\Eloquent\Model';

    /**
     *
     *
     *
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
	$this->fixFiles();
	return "Passport Files have been fixed for MongoDB";
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
	    print_r($filename . " has been Checked/Modified\n");
	}

    }
}
