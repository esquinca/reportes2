<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AddViaticController extends Controller
{
  public function index()
  {
      return view('permitted.viaticos.add_request');
  }
}
