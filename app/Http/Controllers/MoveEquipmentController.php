<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Hotel;
use DB;
use Auth;
use Carbon\Carbon;
use App\Estado;

class MoveEquipmentController extends Controller
{
  /**
   * Show the application move equipment
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
      $hotels = Hotel::select('id', 'Nombre_hotel')->get();
      $estados = Estado::select('id', 'Nombre_estado')->get();
      return view('permitted.equipment.move_equipment',compact('hotels', 'estados'));
  }
}
