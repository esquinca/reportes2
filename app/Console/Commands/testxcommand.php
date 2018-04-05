<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use DB;

class testxcommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'test:test';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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

        // Encuestas clientes.
        //$sql = DB::table('encuesta_user_clientes')->get(); 
        // Encuestas personales (sitwifi).
        $sql = DB::table('encuesta_user_sitwifi')->get();
        dd($sql);
    }
}
