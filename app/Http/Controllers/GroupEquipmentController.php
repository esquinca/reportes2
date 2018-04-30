<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
//use Carbon;

class GroupEquipmentController extends Controller
{
  /**
   * Show the application group equipment
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    $grupos = DB::table('listar_grupos')->get();
    return view('permitted.equipment.group_equipment', compact('grupos'));
  }

  public function update_group(Request $request)
  {
    $group_selected = $request->select1;
    $mac_input = $request->mac;
    //test mac 2C:5D:93:3A:1F:E0 grupo real: Antenas retiradas del Nivel 12, 10 y 9 de Seadust 
    //update mac received. \Carbon\Carbon::now()
    $res = DB::table('equipos')->where('MAC', '=', $mac_input)->update(
      [
        'Nombre_Grupo' => $group_selected,
        'updated_at' => \Carbon\Carbon::now()
      ]);
    //$res8 = DB::select('CALL get_devices_group(?)', array($group_selected));
    return $res;
  }

  public function table_group(Request $request)
  {
    $group_selected = $request->select1;
    $res = DB::select('CALL get_devices_group(?)', array($group_selected));
    return json_encode($res);
  }

  public function update_select(Request $request)
  {
    $grupos = DB::table('listar_grupos')->get();
    return json_encode($grupos);
  }

}
