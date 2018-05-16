<?php

namespace App\Http\Controllers;
use App\Hotel;
use Illuminate\Http\Request;

use DB;

class ZoneToolsController extends Controller
{
  /**
   * Show the application zone tools
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    if (auth()->user()->hasanyrole('SuperAdmin|Admin')) {
		$hotels = Hotel::select('id', 'Nombre_hotel')->get();
		return view('permitted.tools.zone_tools', compact('hotels'));
    }
    else {
		$hotels = auth()->user()->hotels;
		return view('permitted.tools.zone_tools', compact('hotels'));
    }
  }

  public function getInfo(Request $request)
  {
    $select = $request->select;

    $res = DB::select('CALL get_ip_zd_venue(?)', array($select));

    return $res;
  }

}
