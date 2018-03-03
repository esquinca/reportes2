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
class ConfigurationSurveyController extends Controller
{
  /**
   * Show the application configuration survey
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
      $hotels = Hotel::select('id', 'Nombre_hotel')->get();
      $surveys = Encuesta::select('id', 'name')->get();
      $users = User::role('Surveyed')->get();


      return view('permitted.qualification.survey_configuration',compact('hotels', 'surveys', 'users'));
  }
  public function create(Request $request){
    # code...
    $input_hotel= $request->get('select_one');
    $input_user= $request->get('select_two');
    $input_survey= $request->get('select_three');
    $input_date_i= $request->get('date_start');
    $input_date_f= $request->get('date_end');
    $input_date_ev= $request->get('month_evaluate');

    $new_survey_reg = new Encuesta_user;
    $new_survey_reg->hotel_id=$input_hotel;
    $new_survey_reg->user_id=$input_user;
    $new_survey_reg->encuesta_id=$input_survey;
    $new_survey_reg->estatus_id='1';
    $new_survey_reg->fecha_inicial=$input_date_i;
    $new_survey_reg->fecha_corresponde=$input_date_ev.'-01';
    $new_survey_reg->fecha_fin=$input_date_f;

    $new_survey_reg->shell_hotel_id =Crypt::encryptString($input_hotel);
    $new_survey_reg->shell_user_id =Crypt::encryptString($input_user);
    $new_survey_reg->shell_encuesta_id =Crypt::encryptString($input_survey);
    $new_survey_reg->shell_estatus_id =Crypt::encryptString('1');
    $new_survey_reg->shell_fecha_fin =Crypt::encryptString($input_date_f);
    $new_survey_reg->shell_fecha_corresponde	 =Crypt::encryptString($input_date_ev);
    $new_survey_reg->save();


    return $new_survey_reg;
  }
}
