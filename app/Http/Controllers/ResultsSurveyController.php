<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;

class ResultsSurveyController extends Controller
{
  /**
   * Show the application result survey
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
      return view('permitted.qualification.results_survey');
  }

  public function test()
  {
    $result1 = DB::select('CALL NPS (?)', array('2018-02-01'));
    $result2 = DB::select('CALL Get_Comment (?)', array(1));
    // $result3 = DB::select('CALL GetWLAN_top5 (?, ?, ?)', array(7, 2018, 2));
    // $result4 = DB::select('CALL Get_User (?, ?, ?)', array(2018, 2, 7));
    // $result5 = DB::select('CALL Get_GB (?, ?, ?)', array(2018, 2, 7));
    // $result6 = DB::select('CALL Get_MostAP_top5 (?, ?, ?)', array(7, 2018, 2));
    // $result7 = DB::select('CALL Comparative (?, ?)', array(7, '2018-2-01'));

    dd($result2);
  }

  public function result_survey(Request $request)
  {
  	$result1 = DB::select('CALL NPS (?)', array('2018-2-01'));

  	return json_encode($result1);
  }

}
