<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RemovedEquipmentController extends Controller
{
  /**
   * Show the application removed equipment
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
      return view('permitted.equipment.removed_equipment');
  }
}
