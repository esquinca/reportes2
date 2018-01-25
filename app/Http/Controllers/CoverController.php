<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cadena;
use App\Hotel;
use App\Reference;
class CoverController extends Controller
{
  /**
   * Show the application cover
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    if (auth()->user()->hasanyrole('SuperAdmin|Admin')) {
      $hotels = Hotel::select('id', 'Nombre_hotel')->get();
      return view('permitted.inventory.det_cover',compact('hotels'));
    }
    else {
      $hotels = auth()->user()->hotels;
      return view('permitted.inventory.det_cover',compact('hotels'));
    }
  }
}
