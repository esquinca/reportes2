<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cadena;
use App\Hotel;
use App\Reference;
use App\Typereport;
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
      $types = Typereport::all();
      dd($types);
      return view('permitted.report.assign_report',compact('hotels', 'types'));
    }
    else {
      $hotels = auth()->user()->hotels;
      $types = Typereport::all();
      return view('permitted.report.assign_report',compact('hotels', 'types'));
    }
  }
}
