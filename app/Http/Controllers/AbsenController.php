<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class AbsenController extends Controller
{
  public function send(Request $request)
  {
    print_r($request->input());
  }

  public function coba()
  {
    echo "coba";
  }
}
