<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
class ViewDashNPSController extends Controller
{
  public function index()
  {
    return view('permitted.qualification.dashboard_nps');
  }
  public function show_summary_info_nps (Request $request)
  {
    $input_date_i= $request->get('date_to_search');
    if ($input_date_i != '') {
      $date = $input_date_i.'-01';
    }
    else {
      $date_current = date('Y-m');
      $sub_month = strtotime ( '-1 month' , strtotime ( $date_current ) ) ;
      $sub_month = date ( 'Y-m' , $sub_month );
      $date = $sub_month.'-01';

    }
    $result = DB::select('CALL NPS_MONTH (?)', array($date));
    return json_encode($result);
  }
  public function compare_year (Request $request)
  {
    $input_date_i= $request->get('date_to_search');
    if ($input_date_i != '') {
      $dateyearmonth =  explode('-', $input_date_i);
      $yearA= $dateyearmonth[0];
      $yearB = $yearA-1;

    }
    else {
      $date_current = date('Y');
      $sub_year = strtotime ( '-1 year' , strtotime ( $date_current ) ) ;
      $sub_year = date ( 'Y' , $sub_year );

      $yearA = $date_current;
      $yearB = $sub_year;

    }
    $result = DB::select('CALL NPS_YEAR  (?, ?)', array($yearA, $yearB));
    return json_encode($result);
  }
  public function percent_graph_nps (Request $request)
  {
    $input_date_i= $request->get('date_to_search');
    if ($input_date_i != '') {
      $date = $input_date_i.'-01';
    }
    else {
      $date_current = date('Y-m');
      $sub_month = strtotime ( '-1 month' , strtotime ( $date_current ) ) ;
      $sub_month = date ( 'Y-m' , $sub_month );
      $date = $sub_month.'-01';

    }
    $result = DB::select('CALL NPS_MONTH_GRAPH (?)', array($date));
    return json_encode($result);
  }
  public function cant_graph_ppd(Request $request)
  {
    $input_date_i= $request->get('date_to_search');
    if ($input_date_i != '') {
      $date = $input_date_i.'-01';
    }
    else {
      $date_current = date('Y-m');
      $sub_month = strtotime ( '-1 month' , strtotime ( $date_current ) ) ;
      $sub_month = date ( 'Y-m' , $sub_month );
      $date = $sub_month.'-01';
    }
    $result = DB::select('CALL PERCENT_MONTH (?)', array($date));
    return json_encode($result);
  }
  public function graph_uvsr(Request $request)
  {
    $input_date_i= $request->get('date_to_search');
    if ($input_date_i != '') {
      $date = $input_date_i.'-01';
    }
    else {
      $date_current = date('Y-m');
      $sub_month = strtotime ( '-1 month' , strtotime ( $date_current ) ) ;
      $sub_month = date ( 'Y-m' , $sub_month );
      $date = $sub_month.'-01';
    }
    $result = DB::select('CALL NPS_VS_REQUEST (?)', array($date));
    return json_encode($result);
  }


}