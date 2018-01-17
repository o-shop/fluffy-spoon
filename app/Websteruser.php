<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Websteruser extends Model
{
  protected $connection = 'mysql2';
  protected $table = 'webster_userinfo';
  
  public function absen()
  {
    return $this->hasMany('App\Webster', 'userid', 'userid')->orderBy('checktime', 'desc');
  }

  public function latestAbsen()
  {
    return $this->hasOne('App\Webster', 'userid', 'userid')->orderBy('checktime', 'desc');
  }
}
