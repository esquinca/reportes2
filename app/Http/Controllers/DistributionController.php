<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cadena;
use App\Hotel;
use App\Reference;
class DistributionController extends Controller
{
  /**
   * Show the application distribution
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
      return view('permitted.inventory.det_distribution');
  }
  public function show(Request $request)
  {
    $hotels = Hotel::select('Nombre_hotel', 'Direccion', 'Latitude', 'Longitude')->get();
    return json_encode($hotels);
  }

}
