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
    $input_hotel= $request->get('select_one');//<-array
    $var_input_hotel=implode("&", $input_hotel);
    $input_user= $request->get('select_two');//<--array
    $input_survey= $request->get('select_three');
    $input_date_i= $request->get('date_start');
    $input_date_f= $request->get('date_end');
    $input_date_ev= $request->get('month_evaluate');

    $date_eva=$input_date_ev.'-01';
    $var_ac='false';

    for ($i=0; $i <= count($input_user)-1; $i++) {

      $new_survey_reg = new Encuesta_user;
      $new_survey_reg->hotel_id=$var_input_hotel;
      $new_survey_reg->user_id=$input_user[$i];
      $new_survey_reg->encuesta_id=$input_survey;
      $new_survey_reg->estatus_id='1';
      $new_survey_reg->estatus_res=0;
      $new_survey_reg->fecha_inicial=$input_date_i;
      $new_survey_reg->fecha_corresponde=$date_eva;
      $new_survey_reg->fecha_fin=$input_date_f;

      $new_survey_reg->shell_hotel_id =Crypt::encryptString($var_input_hotel);
      $new_survey_reg->shell_user_id =Crypt::encryptString($input_user[$i]);
      $new_survey_reg->shell_encuesta_id =Crypt::encryptString($input_survey);
      $new_survey_reg->shell_estatus_id =Crypt::encryptString('1');
      $new_survey_reg->shell_fecha_fin =Crypt::encryptString($input_date_f);
      $new_survey_reg->shell_fecha_corresponde	 =Crypt::encryptString($date_eva);
      $new_survey_reg->save();
      # code...
      $var_ac='true';
    }


    return $var_ac;
  }

  public function index_nps()
  {
      $hotels = Hotel::select('id', 'Nombre_hotel')->get();
      $users = User::role('Surveyed')->get();
      $count_users = User::role('Surveyed')->count();
      $surveyed = DB::table('venue_user_surveyed')->orderBy('nombre', 'asc')->get();

      for ($i=0; $i < $count_users; $i++) {
        $count_hotel_of_user = DB::table('hotel_user')->where('user_id', $users[$i])->count();
        for ($j=0; $j < $count_hotel_of_user; $j++) {

        }
      }

      return view('permitted.qualification.survey_configuration_nps',compact('hotels', 'users', 'surveyed'));
  }
  public function show_nps(Request $request)
  {
    $input_vertical= $request->get('iv');
    $result = DB::select('CALL Get_Cliente_Vertical (?)', array($input_vertical));
    return json_encode($result);
  }
  public function show_client(Request $request)
  {
    $users = User::role('Surveyed')->get();
    return json_encode($users);
  }
  public function show_assign_client_nps(Request $request)
  {
    $resultado= DB::table('venue_user_surveyed')->orderBy('nombre', 'asc')->get();
    return json_encode($resultado);
  }
  public function create_client_nps(Request $request)
  {
    if (auth()->user()->can('Create user')) {
      $name= $request->inputCreatName;
      $email= $request->inputCreatEmail;
      $city= $request->inputCreatLocation;
      $role= '6';

      if (User::where('email', '=', $email)->exists()) {
         notificationMsg('danger', 'Operation Abort!');
         return Redirect::back();
         //return back()->with('statusnotexit', 'Operation Abort!');
      }
      else {
        $new_user = new User;
        $new_user->name=$name;
        $new_user->email=$email;
        $new_user->password= bcrypt('123456');
        $new_user->city=$city;
        $new_user->save();
        $new_user->assignRole($role);
        // return back()->with('statusexit', 'Operation complete!');
        notificationMsg('success', 'Operation complete!');
        return Redirect::back();
      }

    }
    else {
      return back();
      // return back()->with('sta0tus', 'Operation complete!');
    }
  }
  public function creat_assign_client_ht(Request $request)
  {
    # code...
    $client= $request->select_clients;
    $hotels= $request->select_hotels;
    $size_hotels = count($hotels);
    $status = 0;
    echo $size_hotels.'<br>';
    for ($i=0; $i < $size_hotels; $i++) {
      $count_h_x_u = DB::table('hotel_user')->where('user_id', $client)->where('hotel_id', $hotels[$i])->count();
      if ($count_h_x_u == 0) {
        DB::table('hotel_user')->insertGetId(['user_id' => $client, 'hotel_id' => $hotels[$i]]);
        $status = 1;
      }
    }
    if ($status == '1') {
      notificationMsg('success', 'Operation complete!');
      return Redirect::back();
    }
    if ($status == '0') {
      notificationMsg('danger', 'Operation Abort!');
      return Redirect::back();
    }
  }
  public function delete_client_nps(Request $request)
  {
    // if (auth()->user()->can('Delete user cliente')) {
      if (auth()->user()->id == $request->delete_clients) {
        // return 'abort';
        notificationMsg('danger', 'Operation Abort!');
        return Redirect::back();
      }
      else{
        $id_user = $request->delete_clients;
        $user = User::find($id_user);
        $delete_clients = DB::table('hotel_user')->where('user_id', '=', $id_user)->delete();
        $user->menus()->detach(); //Method of eloquent remove all
        $user->delete(); //Method of eloquent remove user

        notificationMsg('success', 'Operation complete!');
        return Redirect::back();
      }
    // }
    // else {
    //   return 'false';
    // }
  }
  public function delete_assign_client_nps(Request $request){
    $hu= $request->uh;
    DB::table('hotel_user')->where('id', '=', $hu)->delete();
    return '1';
  }

  public function capture_individual(Request $request)
  {
    $vertical= $request->select_one;
    $clientes= $request->select_two;
  }
  public function capture_auto(Request $request)
  {
    $vertical= $request->select_one_v;
    $clientes= $request->select_clients_auto;

    $fecha_ini = new DateTime();
    $fecha_ini->modify('first day of this month');
    $fecha_ini->format('d/m/Y');

    $fecha_fin = new DateTime();
    $fecha_fin->modify('last day of this month');
    $fecha_fin->format('d/m/Y');

    $fecha_cur = date('Y-m-j');
    $mesanterior = strtotime ( '-1 month' , strtotime ( $fecha_cur ) ) ;
    $mesanterior = date ( 'Y-m-j' , $mesanterior );

    for ($i=0; $i < count($clientes); $i++) {
      $count_hotel_of_user = DB::table('encuesta_users')
                            ->where('user_id', $clientes[$i])
                            ->where('encuesta_id', '1')
                            ->where('fecha_inicial', $fecha_ini)
                            ->where('fecha_corresponde', $mesanterior)
                            ->where('fecha_fin', $fecha_fin)
                            ->count();
      if ($count_hotel_of_user != 0) {
        
      }

    }

  }

}
