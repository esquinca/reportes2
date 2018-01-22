<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DistributionController extends Controller
{
  /**
   * Show the application distribution
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
      return view('permitted.inventory.det_distribution');
  }
}
