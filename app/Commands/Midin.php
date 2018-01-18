<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class Midin extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'midin:test';

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
      $this->comment('start');
      $commands = "ps -ef | grep amazonaws";
      \SSH::run($commands, function($line){
        $connect = false;
        if(strpos($line, 'ssh') !== false){
          $connect = true;
        }
        if(!$connect){
          echo "belum Connect";
          \SSH::run([
            'ls'
          ]);
        }
      });
      // $this->comment($var);
      $this->comment('end');
    }
}
