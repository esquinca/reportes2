<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
use Carbon\Carbon;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\User; //Importar el modelo eloquent
use App\Cadena;
use App\Viatic_service;
use App\Viatic_beneficiary;
use App\Viatic_state;
use App\Viatic_list_concept;
use App\Jefedirecto;
use App\Hotel;
use App\Reference;

class AddViaticController extends Controller
{
  public function index()
  {
    $cadena = Cadena::select('id', 'name')->get();
    $service = Viatic_service::select('id', 'name')->get();
    $beneficiary= Viatic_beneficiary::select('id', 'name')->get();
    $concept = Viatic_list_concept::select('id', 'name')->get();
    $jefe = Jefedirecto::select('id', 'Nombre')->get();
    $user = DB::table('sitwifi_email_view')->select('id', 'name')->get();
    return view('permitted.viaticos.add_request2',compact('cadena', 'service', 'beneficiary', 'concept', 'jefe', 'user'));
    // return view('permitted.viaticos.add_request2');$concept = Viatic_list_concept::select('id', 'name')->get();
  }

  public function find_hotel(Request $request)
  {
    $value= $request->numero;
    $hoteles = Hotel::where('cadena_id', $value)->get();
    return json_encode($hoteles);
  }
}
