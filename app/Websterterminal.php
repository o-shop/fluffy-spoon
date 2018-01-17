<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Websterterminal extends Model
{
  protected $connection = 'mysql2';
  protected $table = 'webster_terminal';

  public function absen()
  {
    return $this->hasMany('App\Webster', 'serialno', 'serialno')->orderBy('checktime', 'desc');
  }
}
