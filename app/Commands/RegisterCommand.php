<?php
namespace App\Commands;

use Telegram\Bot\Actions;
use Telegram\Bot\Commands\Command;
use App\Registration;

class RegisterCommand extends Command
{
  protected $name = 'register';

  protected $description = 'Register Authentication';
  public function handle($arguments)
  {
    $data = explode(' ', $arguments);
    $updates = $this->getTelegram()->getUpdates();
    foreach($updates as $update){
      $chat_id = $update['message']['chat']['id'];
      $register = Registration::firstOrCreate(['chat_id' => $chat_id]);
      $this->replyWithMessage(['text' => "Thanks For Your Registration"]);
    }

  }
}
