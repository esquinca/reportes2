<?php

namespace App\Http\Controllers;
use App\Hotel;
use Illuminate\Http\Request;

class EditReportController extends Controller
{
  public function index()
  {
    if (auth()->user()->hasanyrole('SuperAdmin|Admin')) {
      $hotels = Hotel::select('id', 'Nombre_hotel')->get();
      return view('permitted.report.edit_reports',compact('hotels'));
    }
    else {
      $hotels = auth()->user()->hotels;
      return view('permitted.report.edit_reports',compact('hotels'));
    }
  }
}
