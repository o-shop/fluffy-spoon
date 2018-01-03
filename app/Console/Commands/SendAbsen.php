<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class SendAbsen extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'absen:send';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send Absen Via API to HRIS';

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
      $client = new \GuzzleHttp\Client();
      $res = $client->request('POST', env("HRIS_URL","http://webster.hris.local/absen"),
      [
        'form_params' => [
          'coba' => 'saja', // test parameter
        ]
      ]);

      $body = $res->getBody();
      $hasil = get_class($client);
      $this->comment(PHP_EOL.$body.PHP_EOL);
    }
}
