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
}
