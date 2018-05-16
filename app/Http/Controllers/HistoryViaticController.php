<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HistoryViaticController extends Controller
{
  public function index()
  {
      return view('permitted.viaticos.history_requests');
  }
}
