<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HotelPController extends Controller
{
  /**
   * Show the application hotel for project.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
      return view('permitted.inventory.det_project');
  }
}
