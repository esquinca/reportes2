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
use App\Mail\Sentsurveysitwifimail;
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

  public function send_mail(Request $request)
  {
  	$flag = 0;
  	$id_registro = $request->uh;
  	$res2 = DB::table('encuesta_users')->select('user_id', 'estatus_res','shell_data', 'shell_status')->where('id', $id_registro)->get();

  	$user_id = $res2[0]->user_id;
    $estatus = $res2[0]->estatus_res;

    if ($estatus === 0) {
      $sql = DB::table('users')->select('email', 'name')->where('id', $user_id)->get();

      $name = $sql[0]->name;
      $email = $sql[0]->email;

      
      $encriptodata = $res2[0]->shell_data;
      $encriptostatus = $res2[0]->shell_status;

      $datos = [
       'nombre' => $name,
       'shell_data' => $encriptodata,
       'shell_status' => $encriptostatus
      ];

      $this->sentSurveyEmail($email, $datos);
      return $flag = 1;
    }else{
      return $flag;
    }

  	return $flag;
  }

  public function sentSurveyEmail($email, $data)
  {

      // $nombre = $data[$i]['name'];
      // $correo = $data[$i]['email'];
      // $shell1 = $data[$i]['shelldata'];
      // $shell2= $data[$i]['shellstatus'];


      Mail::to($email)->send(new Sentsurveysitwifimail($data));

  }

}
