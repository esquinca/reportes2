<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SearchEquipmentController extends Controller
{
  /**
   * Show the application search equipment
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
      return view('permitted.equipment.search_equipment');
  }
}
