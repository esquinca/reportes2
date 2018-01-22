<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ZoneToolsController extends Controller
{
  /**
   * Show the application zone tools
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
      return view('permitted.tools.zone_tools');
  }
}
