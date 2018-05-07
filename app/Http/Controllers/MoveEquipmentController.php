<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use App\Hotel;
use DB;
use Auth;
use Carbon\Carbon;
use App\Estado;

class MoveEquipmentController extends Controller
{
  /**
   * Show the application move equipment
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
      $hotels = Hotel::select('id', 'Nombre_hotel')->get();
      $estados = Estado::select('id', 'Nombre_estado')->get();
      return view('permitted.equipment.move_equipment',compact('hotels', 'estados'));
  }
  public function edit(Request $request)
  {
    $equipos = json_decode($request->idents);
    $destino_n = $request->destino;
    $estatus_n = $request->estatus;

    $valor= 'false';
    for ($i=0; $i <= (count($equipos)-1); $i++) {
      if ($estatus_n == '999') {
        $sql = DB::table('equipos')->where('id', '=', $equipos[$i])->update(['hotel_id' => $destino_n, 'updated_at' => Carbon::now()]);
      }
      else {
        $sql = DB::table('equipos')->where('id', '=', $equipos[$i])->update(['hotel_id' => $destino_n, 'estados_id' => $estatus_n, 'updated_at' => Carbon::now()]);
      }
      $valor= 'true';
    }
    return $valor;
  }
  public function descrip(Request $request)
  {
    $estatus_n = $request->sector;
    $result = DB::select('CALL get_descripcion (?)', array($estatus_n));

    $n_id=  Crypt::encryptString($result[0]->id);
    $array = [
        "id" => $n_id,
        "description" => $result[0]->Descripcion,
    ];
    return json_encode($array);
  }

  public function update(Request $request)
  {
    $id_equipo = Crypt::decryptString($request->tokensito);
    $description = $request->descript;
    $valor= 'false';

    if (strlen ($description) <= '150') {
      $sql = DB::table('equipos')->where('id', '=', $id_equipo)->update(['Descripcion' => $description, 'updated_at' => Carbon::now()]);
      $valor= 'true';
    }
    else {
      $valor= 'false';
    }
    return $valor;
  }
}
