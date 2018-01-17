<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Webster;

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
      $absen = Webster::whereNull('updated')->where('userid','<>','0')->get();
      foreach($absen as $data){
        $client = new \GuzzleHttp\Client();
        $res = $client->request('POST', env("HRIS_URL","http://webster.hris.local/absen"),
        [
          'form_params' => [
            // "workdate" => "2018-01-01 10:00:00",
            // "finger" => "601",
            // "company" => "1000",
            // "location" => "Senayan City",
            // "status" => "IN"
            "workdate" => $data->checktime,
            "finger" => $data->userid,
            "company" => env("HRIS_COMPANY_CODE","1000"),
            "location" => $data->terminal->description,
            "status" => $data->status
          ]
        ]);

        $body = $res->getBody()." data : ".json_encode($data);
        $hasil = get_class($client);
        $this->comment(PHP_EOL.$body.PHP_EOL);
        if($res->getBody() == "0"){
          $this->comment("updated = 1");
          $data->updated=1;
          $data->save();
        }
      }
    }
}
