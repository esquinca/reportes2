<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
}
