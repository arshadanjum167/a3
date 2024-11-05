<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Http\Controllers\CronController;
use Illuminate\Http\Request;

class Expireuserplan extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'expire:userplan';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Expire user plan ,call once in a day';

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
    public function handle(CronController $CronController,Request $request)
    {
        //
        $CronController->expireonetimesubscription($request);
    }
}
