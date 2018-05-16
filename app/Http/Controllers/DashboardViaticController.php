<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardViaticController extends Controller
{
  public function index()
  {
      return view('permitted.viaticos.dashboard_viaticos');
  }
}
