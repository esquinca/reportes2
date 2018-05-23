<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;

use Auth;

use Carbon\Carbon;

use Spatie\Permission\Models\Role;

use Spatie\Permission\Models\Permission;

use App\User; //Importar el modelo eloquent

class ViaticNotificationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store()
    {

    }
    public function show()
    {
      if (auth()->user()->can('Travel allowance notification')) {
        if (auth()->user()->can('View level zero notifications')){
        }
        if (auth()->user()->can('View level one notifications')){
        }
        if (auth()->user()->can('View level two notifications')){
        }
        if (auth()->user()->can('View level three notifications')){
        }
        if (auth()->user()->can('View level four notifications')){
        }
        $users = User::all();
        return json_encode($users);
      }
      else {
        $array = array();
        return json_encode($array);
      }
    }
}
