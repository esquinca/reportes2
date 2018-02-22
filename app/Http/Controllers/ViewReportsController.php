<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Hotel;
use App\Typereport;
use DB;
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

  public function test()
  {
    $result1 = DB::select('CALL report_venue_header (?, ?, ?)', array(9, 2, 2018));
    $result2 = DB::select('CALL GetWLAN (?, ?, ?)', array(7, 2018, 02));
    $result3 = DB::select('CALL GetWLAN_top5 (?, ?, ?)', array(7, 2018, 2));
    $result4 = DB::select('CALL Get_User (?, ?, ?)', array(2018, 2, 7));
    $result5 = DB::select('CALL Get_GB (?, ?, ?)', array(2018, 2, 7));
    $result6 = DB::select('CALL Get_MostAP_top5 (?, ?, ?)', array(7, 2018, 2));
    $result7 = DB::select('CALL Comparative (?, ?)', array(7, '2018-2-01'));

    dd($result7);
  }

  public function report_header(Request $request)
  {
    $hotel = $request->data_one;
    $date = $request->data_two;

    $datemonthyear =  explode('-', $date);
    $dateyear= (int)$datemonthyear[0];
    $datemonth= (int)$datemonthyear[1];


    $result1 = DB::select('CALL report_venue_header (?, ?, ?)', array($hotel, $datemonth, $dateyear));

    return json_encode($result1);
  }

  public function graph_client_wlan(Request $request)
  {
    $hotel = $request->data_one;
    $date = $request->data_two;

    $datemonthyear =  explode('-', $date);
    $dateyear= (int)$datemonthyear[0];
    $datemonth= (int)$datemonthyear[1];
    
    $result1 = DB::select('CALL GetWLAN (?, ?, ?)', array($hotel, $dateyear, $datemonth));

    return json_encode($result1);
  }

  public function client_wlan_top(Request $request)
  {
    $hotel = $request->data_one;
    $date = $request->data_two;

    $datemonthyear =  explode('-', $date);
    $dateyear= (int)$datemonthyear[0];
    $datemonth= (int)$datemonthyear[1];
    
    $result1 = DB::select('CALL GetWLAN_top5 (?, ?, ?)', array($hotel, $dateyear, $datemonth));

    return json_encode($result1);
  }

  public function user_month(Request $request)
  {
    $hotel = $request->data_one;
    $date = $request->data_two;

    $datemonthyear =  explode('-', $date);
    $dateyear= (int)$datemonthyear[0];
    $datemonth= (int)$datemonthyear[1];
    
    $result1 = DB::select('CALL Get_User (?, ?, ?)', array($dateyear, $datemonth, $hotel));

    return json_encode($result1);
  }

  public function gb_month(Request $request)
  {
    $hotel = $request->data_one;
    $date = $request->data_two;

    $datemonthyear =  explode('-', $date);
    $dateyear= (int)$datemonthyear[0];
    $datemonth= (int)$datemonthyear[1];
    
    $result1 = DB::select('CALL Get_GB (?, ?, ?)', array($dateyear, $datemonth, $hotel));

    return json_encode($result1);
  }

  public function mostAP_top5(Request $request)
  {
    $hotel = $request->data_one;
    $date = $request->data_two;

    $datemonthyear =  explode('-', $date);
    $dateyear= (int)$datemonthyear[0];
    $datemonth= (int)$datemonthyear[1];
    
    $result1 = DB::select('CALL Get_MostAP_top5 (?, ?, ?)', array($hotel, $dateyear, $datemonth));

    return json_encode($result1);
  }

  public function tab_comparativa(Request $request)
  {
    $hotel = $request->data_one;
    $date = $request->data_two;

    $datemonthyear =  explode('-', $date);
    $dateyear= (int)$datemonthyear[0];
    $datemonth= (int)$datemonthyear[1];
    $datefull = $dateyear . '-' . $datemonth . '-01';
    
    $result1 = DB::select('CALL Comparative (?, ?)', array($hotel, $datefull));

    return json_encode($result1);
  }
}
