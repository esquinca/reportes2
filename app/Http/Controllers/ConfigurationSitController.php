<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Carbon\Carbon;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Crypt;
use App\User;
use DateTime;
use DB;
use Auth;
use Mail;
use App\Hotel;
use App\Encuesta;
use App\Encuesta_user;
use App\Pregunta;
use App\Qualification_result;
use App\Vertical;

class ConfigurationSitController extends Controller
{
  public function index()
  {
    // $results = DB::select('select substring_index(email, "@", -1) as domain, count(*) from users group by substring_index(email, "@", -1)');
    $encuestas = Encuesta::select('id', 'name')->where('id', '!=', 1)->get();


    $dominios = DB::select('select substring_index(email, "@", -1) as domain from users group by substring_index(email, "@", -1)');
    return view('permitted.qualification.survey_sit_configuration',compact('dominios', 'encuestas'));
  }
}
