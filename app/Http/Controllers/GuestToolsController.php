<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GuestToolsController extends Controller
{
  /**
   * Show the application guest tools
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
      return view('permitted.tools.guest_tools');
  }
}
