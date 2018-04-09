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
use App\Mail\Sentsurveynpsmail;
use App\Mail\Sentsurveyrangelmail;
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
    $vertical= $request->select_ind_one;
    $clientes= $request->select_ind_two;
    $date_i= $request->date_start;
    $date_e= $request->date_end;
    $date_m= $request->month_evaluate;

    $operacion='0';

    for ($i=0; $i < count($clientes); $i++) {
      $month=$date_m.'-01';

      $pregunto = DB::table('encuesta_users')
                            ->where('user_id', $clientes[$i])
                            ->where('encuesta_id', '1') // id encuesta nps
                            ->where('estatus_id', '1') //Activa
                            ->where('estatus_res', '0') //NO CONTESTADA
                            ->where('fecha_corresponde', $month)
                            ->count();

      if ($pregunto == '0') {
        $nuevolink = $clientes[$i].'/'.'1'.'/'.$month.'/'.$date_e;
        $encriptodata= Crypt::encryptString($nuevolink);
        $encriptostatus= Crypt::encryptString('1');

        $new_survey_individual = new Encuesta_user;
        $new_survey_individual->user_id=$clientes[$i];
        $new_survey_individual->encuesta_id='1';
        $new_survey_individual->estatus_id='1';
        $new_survey_individual->estatus_res='0';
        $new_survey_individual->fecha_inicial=$date_i;
        $new_survey_individual->fecha_corresponde=$month;
        $new_survey_individual->fecha_fin=$date_e;
        $new_survey_individual->shell_data=$encriptodata;
        $new_survey_individual->shell_status=$encriptostatus;
        $new_survey_individual->save();
        $sql = DB::table('users')->select('email', 'name')->where('id', $clientes[$i])->get();
        $datos = [
           'nombre' => $sql[0]->name,
           'shell_data' => $encriptodata,
           'shell_status' => $encriptostatus
        ];
        $this->sentSurveyEmail($sql[0]->email, $datos);

        $operacion='1';
      }
      else {
        $operacion='0';
      }
      // $operacion='1';
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

  public function capture_auto(Request $request)
  {
    $vertical= $request->select_one_v;
    $clientes= $request->select_clients_auto;

    $fecha_ini = date('Y-m-01');
    $fecha_fin = date('Y-m-t');
    $fecha_cur = date('Y-m');

    $mesanterior = strtotime ( '-1 month' , strtotime ( $fecha_cur ) ) ;
    $mesanterior = date ( 'Y-m' , $mesanterior );

    $mesanteriorfull = $mesanterior . '-01';

    $operacion='0';

    for ($i=0; $i < count($clientes); $i++) {
      $count_hotel_of_user = DB::table('encuesta_users')
                            ->where('user_id', $clientes[$i])
                            ->where('encuesta_id', '1')
                            ->where('fecha_inicial', $fecha_ini)
                            ->where('fecha_corresponde', $mesanteriorfull)
                            ->where('fecha_fin', $fecha_fin)
                            ->count();
        //echo "count: " . $count_hotel_of_user . "<br>";
      if ($count_hotel_of_user === 0) {

        $nuevolink = $clientes[$i].'/'.'1'.'/'.$mesanteriorfull.'/'.$fecha_fin;
        $encriptodata= Crypt::encryptString($nuevolink);
        $encriptostatus= Crypt::encryptString('1');

        //echo $clientes[$i] . ": es 0 -- Link:  " . $nuevolink ."\n ". "<br>";

        $new_survey_individual = new Encuesta_user;
        $new_survey_individual->user_id=$clientes[$i];
        $new_survey_individual->encuesta_id='1';
        $new_survey_individual->estatus_id='1';
        $new_survey_individual->estatus_res='0';
        $new_survey_individual->fecha_inicial=$fecha_ini;
        $new_survey_individual->fecha_corresponde=$mesanteriorfull;
        $new_survey_individual->fecha_fin=$fecha_fin;
        $new_survey_individual->shell_data=$encriptodata;
        $new_survey_individual->shell_status=$encriptostatus;
        $new_survey_individual->save();

        $operacion='1';
      }else{
        //echo $clientes[$i] . ": es 1 " . "<br>";
      }

    }
    if ($operacion == '1') {
      notificationMsg('success', 'Operation complete!');
      return Redirect::back();
    }
    if ($operacion == '0') {
      notificationMsg('danger', 'No changes were applied!');
      return Redirect::back();
    }

    //dd($count_sql);

  }

  public function user_surveys_table(Request $request)
  {
    $result = DB::table('encuesta_user_clientes')->get();
    //->orderBy('nombre', 'asc')
    return json_encode($result);
  }

  public function send_mail(Request $request)
  {
    $flag = 0;
    $string1 = "";
    $id_registro = $request->uh;
    $res1 = DB::table('encuesta_user_clientes')->select('clientes', 'email', 'Special')->where('id_eu', $id_registro)->get();
    $res2 = DB::table('encuesta_users')->select('user_id', 'estatus_res','shell_data', 'shell_status')->where('id', $id_registro)->get();

    $name = $res1[0]->clientes;
    $email = $res1[0]->email;
    $status = $res1[0]->Special;

    $user_id = $res2[0]->user_id;
    $estatus_res = $res2[0]->estatus_res;
    $encriptodata = $res2[0]->shell_data;
    $encriptostatus = $res2[0]->shell_status;

    if ($estatus_res === 1) {
      if ($status === 0) {
        $datos = [
           'nombre' => $name,
           'shell_data' => $encriptodata,
           'shell_status' => $encriptostatus
        ];

        $this->sentSurveyEmail($email, $datos);
        return $flag = 1;
      }else{
        $res3 = DB::select('CALL buscar_venue_user(?)', array($res2[0]->user_id));
        $count = count($res3);

        for ($i=0; $i < $count; $i++) {
            $string1 = $string1 . $res3[$i]->Nombre_hotel . ", ";
        }
        $string1 = substr($string1, 0, -2);

        $datos = [
           'nombre' => $name,
           'string' => $string1,
           'shell_data' => $encriptodata,
           'shell_status' => $encriptostatus
        ];

        $this->sentSurveyEmailRangel($datos);
        return $flag = 1;
      }
    }else{
      return $flag;
    }

    return $flag;
  }

  public function sentSurveyEmailRangel($data)
  {
      // $datos = [
      //    'nombre' => $sql[0]->name,
      //    'shell_data' => $encriptodata,
      //    'shell_status' => $encriptostatus
      // ];
      Mail::to('crangel@sitwifi.com')->send(new Sentsurveyrangelmail($data));
  }

  public function sentSurveyEmail($email, $data)
  {
      // $datos = [
      //    'nombre' => $sql[0]->name,
      //    'shell_data' => $encriptodata,
      //    'shell_status' => $encriptostatus
      // ];

      Mail::to($email)->send(new Sentsurveynpsmail($data));

  }
  public function search_hotel_user(Request $request)
  {
    $id_registro= $request->uh;
    $user = DB::table('encuesta_users')->where('id', $id_registro)->value('user_id');
    $result1 = DB::select('CALL  buscar_venue_user (?)', array($user));

    return json_encode($result1);

  }

}
