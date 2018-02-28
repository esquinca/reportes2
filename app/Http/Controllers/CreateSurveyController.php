<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CreateSurveyController extends Controller
{
  /**
   * Show the application create survey
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
      return view('permitted.qualification.create_survey');
  }
  public function create(Request $request)
  {
    $titulo = $request->title;
    $cont_option =$request->option;
    $tamano = count($cont_option);
    echo $titulo.'<br>';
    for ($i=0; $i < $tamano; $i++) {
      echo $i.'<br>';
      if ( !empty($cont_option[$i]) ) {
        echo $cont_option[$i].'<br>';
      }
    }

   //dd($tamano);
  }
}
