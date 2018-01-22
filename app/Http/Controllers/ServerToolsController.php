<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ServerToolsController extends Controller
{
  /**
   * Show the application server tools
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
      return view('permitted.tools.server_tools');
  }
}
