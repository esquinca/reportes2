<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HotelDController extends Controller
{
  /**
   * Show the application hotel detailed.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
      return view('permitted.inventory.det_hotel');
  }
}
