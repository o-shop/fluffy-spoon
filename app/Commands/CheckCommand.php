<?php
namespace App\Commands;

use Telegram\Bot\Actions;
use Telegram\Bot\Commands\Command;
use App\Registration;

class CheckCommand extends Command
{
  protected $name = 'check';

  protected $description = 'check';
  public function handle($arguments)
  {
    $data = explode(' ', $arguments);
    $chat_id = $this->getTelegram()->getWebhookUpdates()->getMessage()->getChat()->getId();
    $reg = Registration::where('status', '1')->where('chat_id', $chat_id)->first();
    if($reg){
      $commands = "ps -ef | grep amazonaws";
      \SSH::run($commands, function($line){
        $text = "start";
        $connect = false;
        if(strpos($line, 'ssh') !== false){
          $connect = true;
        }
        if(!$connect){
          $this->replyWithMessage(['text' => "Not connected, Reconnecting"]);
          \SSH::run('sh tunnel.sh',function($x){
            $this->replyWithMessage(['text' => $x]);
          });
        }else{
          $this->replyWithMessage(['text' => "Connected"]);
        }

      });
    }else{
      $this->replyWithMessage(['text' => "You Are Not Allowed to check"]);
    }
  }
}
