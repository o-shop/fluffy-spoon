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
    $chat_id = $this->getTelegram()->getWebhookUpdates()->getMessage()->getChat()->getId();

    $register = Registration::firstOrCreate(['chat_id' => $chat_id]);
    $this->replyWithMessage(['text' => "Thanks For Your Registration"]);

  }
}
