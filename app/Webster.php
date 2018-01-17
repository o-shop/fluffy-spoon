<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Webster extends Model
{
  protected $connection = 'mysql2';
  protected $table = 'webster_checkinout';
  public $timestamps = false;

  public function user()
  {
    return $this->belongsTo('App\Websteruser', 'userid', 'userid');
  }
  public function terminal()
  {
    return $this->belongsTo('App\Websterterminal', 'serialno', 'serialno');
  }
  public function getStatusAttribute()
  {
    switch ($this->checktype) {
      case '0':
        return "IN";
        break;
      case '1':
        return "OUT";
        break;
      default:
        # code...
        break;
    }
  }
}
