<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GroupEquipmentController extends Controller
{
  /**
   * Show the application group equipment
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
      return view('permitted.equipment.group_equipment');
  }
}
