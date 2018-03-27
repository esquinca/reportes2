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

class ViewDashSitController extends Controller
{
  public function index()
  {
    $surveys = Encuesta::select('id', 'name')->get();
    return view('permitted.qualification.dashboard_sit',compact( 'surveys'));
  }
  public function show_q(Request $request)
  {
    $input_survey= $request->get('select_surveys');
    $sacar_preg = Encuesta::find($input_survey)->preguntas()->where('encuesta_id', $input_survey)->get();
    return $sacar_preg;
  }
  public function show_result_q(Request $request)
  {
    $input_date_0= $request->get('date');
    $input_q= $request->get('question');
    $input_date_1 = $input_date_0.'-01';
    $result = DB::select('CALL Survey_Question (?, ?)', array($input_date_1, $input_q));
    return json_encode($result);
  }
}
