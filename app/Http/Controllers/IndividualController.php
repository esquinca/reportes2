<?php

namespace App\Http\Controllers;
use App\Hotel;
use Illuminate\Http\Request;

class IndividualController extends Controller
{
  public function index()
  {
    if (auth()->user()->hasanyrole('SuperAdmin|Admin')) {
      $hotels = Hotel::select('id', 'Nombre_hotel')->get();
      return view('permitted.report.individual',compact('hotels'));
    }
    else {
      $hotels = auth()->user()->hotels;
      return view('permitted.report.individual',compact('hotels'));
    }
  }
  public function upload_client(Request $request)
  {
  return $request;
  }
  public function upload_banda(Request $request)
  {
  return $request;
  }
}
