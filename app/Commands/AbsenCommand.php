<?php
namespace App\Commands;

use Telegram\Bot\Actions;
use Telegram\Bot\Commands\Command;
use App\Webster;
use App\Websteruser;

class AbsenCommand extends Command
{
  protected $name = 'absen';

  protected $description = 'Absen Command Usage : /absen [name] [IN/OUT/ALL] [N latest]';
  public function handle($arguments)
  {
    $data = explode(' ', $arguments);

    $name = (isset($data[0]) && !empty($data[0])) ? $data[0] : "Hamidin";
    $checktype = isset($data[1]) ? (strtoupper($data[1]) == "IN" ? 0 : 1) : 0;

    $limit = isset($data[2]) ? $data[2] : 1;
	  // $absen = Webster::where('userid',601)->orderBy('id', 'desc')->get()->first();
    $user = Websteruser::where('name', $name)->first();
    if(count($user) > 0){
      // $absen = $user->absen;
      if(isset($data[1]) && $data[1] != 'ALL'){
        $absen = $user->absen->where('checktype', $checktype)->take($limit);
      }else{
        $absen = $user->absen->take($limit);
      }

      $detail = "\n";
      foreach($absen as $row){
        $detail .= $row->checktype == 0 ? "IN" : "OUT";
        $detail .=" : ";
        $detail .= $row->checktime;
        $detail .= "\n";
      }
      $text = trim($user->name)." dengan data absen : ".$detail;
    }
    else {
      $text = "User not found";
    }
/*
SELECT checktime, checktype, wu.name, wu.userid
	FROM webster.webster_checkinout wc
	JOIN webster.webster_userinfo wu on wc.userid=wu.userid
	WHERE wu.name like '%$name%'
	ORDER BY checktime desc
	LIMIT 1
*/
    // $text .= "\n$data[0]";
    $this->replyWithMessage(['text' => $text]);
  }
}
