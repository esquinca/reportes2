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

use Illuminate\Support\Facades\Redirect;

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
  public function show_user(Request $request)
  {
    $input_domain= $request->get('domain');
    $result = User::select('id', 'name')->get();
    // $result = DB::select('CALL Get_Cliente_Vertical (?)', array($input_domain));
    return json_encode($result);
  }
  public function survey_record(Request $request)
  {
    $input_domain = $request->get('select_ind_one');
    $input_emails = $request->get('select_ind_two');
    $input_survey = $request->get('select_idsurvey');
    $input_date_1 = $request->get('date_start');
    $input_date_2 = $request->get('date_end');
    $input_date_e = $request->get('month_evaluate');

    $operacion='0';

    for ($i=0; $i < count($input_emails); $i++) {
      // $input_emails[$i].'<BR>';

      $month=$input_date_e.'-01';
      $nuevolink = $input_emails[$i].'/'.$input_survey.'/'.$month.'/'.$input_date_2;
      $encriptodata= Crypt::encryptString($nuevolink);
      $encriptostatus= Crypt::encryptString('1');

      $new_survey_individual = new Encuesta_user;
      $new_survey_individual->user_id=$input_emails[$i];
      $new_survey_individual->encuesta_id=$input_survey;
      $new_survey_individual->estatus_id='1';
      $new_survey_individual->estatus_res='0';
      $new_survey_individual->fecha_inicial=$input_date_1;
      $new_survey_individual->fecha_corresponde=$month;
      $new_survey_individual->fecha_fin=$input_date_2;
      $new_survey_individual->shell_data=$encriptodata;
      $new_survey_individual->shell_status=$encriptostatus;
      $new_survey_individual->save();

      $operacion='1';
    }
    if ($operacion == '1') {
        notificationMsg('success', 'Operation complete!');
        return Redirect::back();
    }
    if ($operacion == '0') {
        notificationMsg('danger', 'Operation Abort!');
        return Redirect::back();
    }

  }
}
