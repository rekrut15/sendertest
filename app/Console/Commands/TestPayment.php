<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Transaction;

class TestPayment extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'test:payment';

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
		for ($i=0;$i<10;$i++){
			$p=new Transaction;
			$p->sendTestPayment("http://recievertest.mambrin.ru?data=");
		}
		
        //
    }
}
