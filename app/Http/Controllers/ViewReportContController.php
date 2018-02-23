<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cadena;
use App\Hotel;
use App\Reference;
use DB;
class ViewReportContController extends Controller
{
  public function index()
  {
      if (auth()->user()->hasanyrole('SuperAdmin|Admin')) {
        $cadena = Cadena::select('id', 'name')->get();
        return view('permitted.report.view_reports_cont',compact('cadena'));
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
        return view('permitted.report.view_reports_cont',compact('cadena'));
      }
  }
  public function table_gb() {
    # code...
  }
  public function table_user() {
    # code...
  }
}
