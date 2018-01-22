<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MoveEquipmentController extends Controller
{
  /**
   * Show the application move equipment
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
      return view('permitted.equipment.move_equipment');
  }
}
