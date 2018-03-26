<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ViewDashNPSController extends Controller
{
  public function index()
  {
    return view('permitted.qualification.dashboard_nps');
  }
  public function show(Request $request)
  {
    # code...
  }
}
