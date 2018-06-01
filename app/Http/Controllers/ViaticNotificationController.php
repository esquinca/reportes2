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
      $user = Auth::user()->id;

      if (auth()->user()->can('Travel allowance notification')) {
        if (auth()->user()->can('View level zero notifications')){ /*Notificaciones del usuario, con todos sus estatus*/
          $result = DB::select('CALL get_status_notification (?,?)', array($user, 5000));
          return json_encode($result);
        }
        if (auth()->user()->can('View level one notifications')){ /*Notificaciones del usuario, con estatus activo*/
          $result = DB::select('CALL get_status_notification (?,?)', array($user, 1));
          return json_encode($result);
        }
        if (auth()->user()->can('View level two notifications')){ /*Notificaciones del usuario, con estatus pendiente*/
          $result = DB::select('CALL get_status_notification (?,?)', array($user, 2));
          return json_encode($result);
        }
        if (auth()->user()->can('View level three notifications')){ /*Notificaciones del usuario, con estatus verifica*/
          $result = DB::select('CALL get_status_notification (?,?)', array($user, 3));
          return json_encode($result);
        }
        if (auth()->user()->can('View level four notifications')){ /*Notificaciones del usuario, con estatus aprueba*/
          $result = DB::select('CALL get_status_notification (?,?)', array($user, 4));
          return json_encode($result);
        }
      }
      else {
        $array = array();
        return json_encode($array);
      }
    }
}
