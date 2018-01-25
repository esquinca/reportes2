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
      return view('permitted.report.assign_report',compact('hotels', 'types'));
    }
    else {
      $hotels = auth()->user()->hotels;
      $types = Typereport::all();
      return view('permitted.report.assign_report',compact('hotels', 'types'));
    }
  }
  public function show(Request $request)
  {
    $resultados = Typereport::all();
    return json_encode($resultados);
  }
  public function edit(Request $request)
  {
    $id= $request->sector;
    $resultados = Typereport::find($id);
    return json_encode($resultados);
  }
}
