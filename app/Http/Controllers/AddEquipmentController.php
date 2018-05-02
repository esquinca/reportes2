<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Hotel;
use App\Proveedor;
use App\Modelo;
use DB;
use Auth;
use Carbon\Carbon;

class AddEquipmentController extends Controller
{
  /**
   * Show the application add equipment
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    $hotels = Hotel::select('id', 'Nombre_hotel')->get();
    $modelos = DB::table('modelos')->select('id', 'ModeloNombre')->get();
    $marcas = DB::table('marcas')->select('id', 'Nombre_marca')->get();
    $estados = DB::table('get_estados_devices')->select('id', 'Nombre_estado')->get();
    $proveedores = DB::table('list_proveedores')->select('id', 'nombre')->get();
    $especificaciones = DB::table('especificacions')->select('id', 'name')->get();
    return view('permitted.equipment.add_equipment',compact('hotels', 'modelos', 'marcas', 'estados', 'proveedores', 'especificaciones'));
  }
  public function search(Request $request){
    $considencia = $request->key;
    $result = DB::select('CALL get_grupo_rlike (?)', array($considencia));
    return json_encode($result);
  }
}
