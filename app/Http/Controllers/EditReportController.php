<?php

namespace App\Http\Controllers;
use App\Hotel;
use Illuminate\Http\Request;
use DB;
use Auth;
use Carbon\Carbon;

class EditReportController extends Controller
{
  public function index()
  {
    if (auth()->user()->hasanyrole('SuperAdmin|Admin')) {
      $hotels = Hotel::select('id', 'Nombre_hotel')->get();
      return view('permitted.report.edit_reports',compact('hotels'));
    }
    else {
      $hotels = auth()->user()->hotels;
      return view('permitted.report.edit_reports',compact('hotels'));
    }
  }
  public function search_zd(Request $request)
  {
    $hotel = $request->numero;
    $result = DB::select('CALL get_zd_venue (?)', array($hotel));
    return json_encode($result);
  }
  public function search_gb(Request $request)
  {
    $hotel = $request->htl;
    $date = $request->dt;
    $ip = $request->zd;

    $result = DB::select('CALL get_gb_venue_edit (?,?,?)', array($hotel, $date, $ip));
    return json_encode($result);
  }
  public function update_gb(Request $request)
  {
    $hotel = $request->htl;
    $date = $request->dt;
    $ip = $request->zd;
    $giga = $request->gb;
    // $bytes = ((($giga * 1024) * 1024) * 1024);
    $bytes = $giga * 1000000000;

    $res = DB::table('gbxdias')
           ->where('Fecha', '=', $date)
           ->where('hotels_id', '=', $hotel)
           ->where('ZD', '=', $ip)
           ->update(
            [
              'CantidadBytes' => $bytes,
              'ConsumoReal' => $bytes,
              'updated_at' => \Carbon\Carbon::now()
            ]);
    return $res;
  }
  public function search_user(Request $request)
  {
    $hotel = $request->htl;
    $date = $request->dt;

    $result = DB::select('CALL get_user_venue (?,?)', array($hotel, $date));
    return json_encode($result);
  }
  public function update_user(Request $request){
    $hotel = $request->htl;
    $date = $request->dt;
    $user = $request->user;

    $sql = DB::table('usuariosxdias')
    ->select('id')
    ->where('Fecha', $date)
    ->where('hotels_id', $hotel)
    ->get();
    $flag = '0';
    $total_id = count($sql);
    $nueva_cant = ($user / $total_id);
    for ($i=0; $i <= ($total_id-1) ; $i++) {
      $id = $sql[$i]->id;
      $res = DB::table('usuariosxdias')
          ->where('id', '=', $id)
          ->where('Fecha', '=', $date)
          ->where('hotels_id', '=', $hotel)
          ->update(
          [
            'NumClientes' => $nueva_cant,
            'updated_at' => \Carbon\Carbon::now()
          ]);
      $flag = '1';
    }
    return $flag;
  }
  // {
  //   $hotel = $request->htl;
  //   $date = $request->dt;
  //   $giga = $request->user;
  //   $count_md = DB::table('marcas')->where('Nombre_marca', $name)->where('Distribuidor', $dist)->count();
  //   if ($count_md == '0') {
  //     return '0';
  //   }
  //
  //   $res = DB::table('gbxdias')
  //          ->where('Fecha', '=', $date)
  //          ->where('hotels_id', '=', $hotel)
  //          ->where('ZD', '=', $ip)
  //          ->update(
  //           [
  //             'CantidadBytes' => $bytes,
  //             'ConsumoReal' => $bytes,
  //             'updated_at' => \Carbon\Carbon::now()
  //           ]);
  //   return $res;
  // }



}
