<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Hotel;
use App\Typereport;
class ViewReportsController extends Controller
{
  /**
   * Show the application View Reports
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
      return view('permitted.report.view_reports');
  }
  public function typerep(Request $request)
  {
      $value= $request->numero;

      //$hotel = Hotel::select(['Nombre_hotel'])->find($value);
      $hotel = Hotel::find($value);
      $hotel->typereports->toJson();
  
      return $hotel;
      //$selectnivel= DB::table('NivelesReportes')->select('ReporteID','Nivel')->where('HotelID', '=', $value)->get();
      //$selectnivel= DB::table('tipos_reporte_new')->select('fk_tiporeportenew','Nombre')->where('fk_hotel', '=', $value)->get();
      //return json_encode($selectnivel);

  }
}
