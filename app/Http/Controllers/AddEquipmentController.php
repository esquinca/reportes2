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
    $modelos = DB::table('modelos')->select('id', 'ModeloNombre')->orderBy('ModeloNombre', 'asc')->get();
    $marcas = DB::table('marcas')->select('id', 'Nombre_marca')->orderBy('Nombre_marca', 'asc')->get();
    $estados = DB::table('get_estados_devices')->select('id', 'Nombre_estado')->get();
    $proveedores = DB::table('list_proveedores')->select('id', 'nombre')->get();
    $especificaciones = DB::table('especificacions')->select('id', 'name')->get();
    return view('permitted.equipment.add_equipment',compact('hotels','estados', 'proveedores', 'especificaciones'));
  }
  public function search(Request $request){
    $considencia = $request->key;
    $result = DB::select('CALL get_grupo_rlike (?)', array($considencia));
    return json_encode($result);
  }
  public function search_provider(Request $request){
    $result = DB::table('list_proveedores')->orderBy('nombre', 'asc')->get();
    return json_encode($result);
  }
  public function create_Model(Request $request){
    $name = $request->add_modelitho;
    $marca_modl = $request->marcas_current;
    $flag = 0;
    $count_md = DB::table('modelos')->where('ModeloNombre', $name)->where('marca_id', $marca_modl)->count();
    if ($count_md == '0') {
      $result = DB::table('modelos')->insertGetId(['ModeloNombre' => $name, 'marca_id' => $marca_modl ]);
      if($result != '0'){
        $flag =1;
      }
    }
    return $flag;
  }
  public function search_modelo(Request $request){
    $name = $request->numero;
    $result = DB::select('CALL get_model (?)', array($name));
    return json_encode($result);
  }
  public function create_marca(Request $request){
    $name = $request->add_marquitha;
    $dist = $request->add_distribuidor;
    $flag = 0;
    $count_md = DB::table('marcas')->where('Nombre_marca', $name)->count();
    if ($count_md == '0') {
      $result = DB::table('marcas')->insertGetId(['Nombre_marca' => $name, 'Distribuidor' => $dist ]);
      if($result != '0'){
        $flag =1;
      }
    }
    return $flag;
  }
  public function search_marca(Request $request){
    $name = $request->numero;
    $result = DB::select('CALL get_brand (?)', array($name));
    return json_encode($result);
  }

  public function search_marca_all(Request $request){
    $result = DB::table('marcas')->select('id', 'Nombre_marca')->orderBy('Nombre_marca', 'asc')->get();
    return json_encode($result);
  }
}
