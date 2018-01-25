<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cadena;
use App\Hotel;
use App\Reference;
class AssignTypeController extends Controller
{
  /**
   * Show the application view blade Assign Type Report
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    if (auth()->user()->hasanyrole('SuperAdmin|Admin')) {
      $hotels = Hotel::select('id', 'Nombre_hotel')->get();
      return view('permitted.report.assign_report',compact('hotels'));
    }
    else {
      $hotels = auth()->user()->hotels;
      return view('permitted.report.assign_report',compact('hotels'));
    }
  }
}
