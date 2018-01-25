<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cadena;
use App\Hotel;
use App\Reference;
class HotelDController extends Controller
{
  /**
   * Show the application hotel detailed.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    if (auth()->user()->hasanyrole('SuperAdmin|Admin')) {
      $cadena = Cadena::select('id', 'name')->get();
      return view('permitted.inventory.det_hotel',compact('cadena'));
    }
    else {
      $hotel = auth()->user()->hotels;
      $cadena_total =array();
      foreach ($hotel as $data)
      {
          $name_cadena = Cadena::select(['id','name'])->find($data->cadena_id);
          array_push($cadena_total, $name_cadena);
      }
      $cadena = array_values(array_unique($cadena_total));
      return view('permitted.inventory.det_hotel',compact('cadena'));
    }
  }

  public function hotel_cadena(Request $request)
  {
    $value= $request->numero;
    $hoteles = Hotel::find($value);
    $hoteles->hotelCadena->toJson();

    dd($hoteles);


  }

}
