<?php
namespace App\Commands;

use Telegram\Bot\Actions;
use Telegram\Bot\Commands\Command;
use App\Webster;
use App\Websteruser;

class CheckCommand extends Command
{
  protected $name = 'check';

  protected $description = 'check Tunnel';
  public function handle($arguments)
  {
    $data = explode(' ', $arguments);
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

  }
}
