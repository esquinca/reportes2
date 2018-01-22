<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AddEquipmentController extends Controller
{
  /**
   * Show the application add equipment
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
      return view('permitted.equipment.add_equipment');
  }
}
