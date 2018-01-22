<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ConfigurationSurveyController extends Controller
{
  /**
   * Show the application configuration survey
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
      return view('permitted.qualification.survey_configuration');
  }
}
