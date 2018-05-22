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
        
      }
      $users = User::all();
      return json_encode($users);
    }
}
