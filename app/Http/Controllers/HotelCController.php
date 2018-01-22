<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HotelCController extends Controller
{
  /**
   * Show the application hotel with costs.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
      return view('permitted.inventory.det_costs');
  }
}
