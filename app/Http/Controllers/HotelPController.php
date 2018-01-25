<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cadena;
use App\Hotel;
use App\Reference;
class HotelPController extends Controller
{
  /**
   * Show the application hotel for project.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    if (auth()->user()->hasanyrole('SuperAdmin|Admin')) {
      $cadena = Cadena::select('id', 'name')->get();
      return view('permitted.inventory.det_project',compact('cadena'));
    }
    else {
      $hotel = auth()->user()->hotels;
      $cadena_total =array();
      foreach ($hotel as $data)
      {
        $hoteles = Hotel::find($data->id);
        $hoteles->hotelCadena->toArray();
        $id_rec_cadena= $hoteles['hotelCadena'][0]->id;

        $name_cadena = Cadena::select(['id','name'])->find($id_rec_cadena);
        array_push($cadena_total, $name_cadena);
      }
      $cadena = array_values(array_unique($cadena_total));
      return view('permitted.inventory.det_project',compact('cadena'));
    }
  }

}
