<?php
namespace App\Console\Commands;

use Illuminate\Console\Command;

/**
 *
 */
class Getupdates extends Command
{

  protected $name = 'getupdates:command';
  protected $description = 'Get Update For Commands Handler telegram';

  function __construct()
  {
    parent::__construct();
  }

  public function handle()
  {
    $updates = \Telegram::commandsHandler();
    // echo "test";
    // $chat_id = '151065522';
    // \Telegram::sendMessage(['chat_id' => $chat_id, 'text' => 'coba']);
  }
}
