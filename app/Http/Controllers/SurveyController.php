<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Crypt;

use DateTime;

use DB;

use Auth;

use Mail;

use App\Cadena;

use App\Hotel;

use App\Reference;

use App\Encuesta_user;
use App\Encuesta;
use App\Pregunta;
use App\Qualification_result;
use App\Comment;
class SurveyController extends Controller
{
  public function Name()
  {
    $encrypted1 = Crypt::encryptString('2018-01-01');
    return $encrypted1;
  }
  public function index($user, $venium, $survey, $month, $end, $status)
  {
    $encriptado_user = $user;
    $encriptado_venium = $venium;
    $encriptado_survey = $survey;
    $encriptado_month = $month;
    $encriptado_end = $end;
    $encriptado_status = $status;

    $enc_verificar = Encuesta_user::where('shell_hotel_id', '=', $encriptado_venium)
    ->where('shell_user_id', '=', $encriptado_user)
    ->where('shell_encuesta_id', '=', $encriptado_survey)
    ->where('shell_estatus_id', '=', $encriptado_status)
    ->where('shell_fecha_fin', '=', $encriptado_end)
    ->where('estatus_id', '=', 1)
    ->count();
    $ident_preg = '';

    if ($enc_verificar == '1') {

      $encrypted1 = Crypt::decryptString($encriptado_user);
      $encrypted2 = Crypt::decryptString($encriptado_venium);
      $encrypted3 = Crypt::decryptString($encriptado_survey);
      $encrypted4 = Crypt::decryptString($encriptado_end);
      $encrypted6 = Crypt::decryptString($encriptado_month);

      $sacar_preg = Encuesta::find($encrypted3)->preguntas()->where('encuesta_id', $encrypted3)->get();
      $count_preg = $sacar_preg->count();
      //ID DE preguntas
      for ($k=0; $k <$count_preg; $k++) { $ident_preg = $ident_preg.$sacar_preg[$k]->id.'&'; }
      // dd($sacar_preg);

      $enc_data_s = Encuesta_user::select('id')->where('shell_hotel_id', '=', $encriptado_venium)
      ->where('shell_user_id', '=', $encriptado_user)
      ->where('shell_encuesta_id', '=', $encriptado_survey)
      ->where('shell_estatus_id', '=', $encriptado_status)
      ->where('shell_fecha_fin', '=', $encriptado_end)
      ->where('estatus_id', '=', 1)
      ->value('id');

      //Concatenamos variables a enviar
      // var_dump($enc_data_s);
      // dd($enc_data_s);
      $ix= $enc_data_s;
      $id_preguntas = trim($ident_preg, '&');
      $unir_form= $encrypted1.'/'.$ix.'/'.$count_preg.'/'.$id_preguntas.'/'.$encrypted6.'/'.$encrypted2;
      $encrypted_form = Crypt::encryptString($unir_form);

      $pos = strpos($encrypted2, '&');
      if ($pos === false) {
        $array_hotel = array();
        array_push($array_hotel, $encrypted2);
        echo 'Es hotel unico';
        // dd($array_hotel);
      }
      else {
        $array_hotel = explode("&", $encrypted2);
        // dd($array_hotel);
       return view('permitted.qualification.view_survey',compact('encrypted4', 'encrypted_form','unir_form', 'sacar_preg'));
      }
      //return view('permitted.qualification.view_survey');
    }
    else {
      $message = 'La URL es incorrecta o la encuesta que buscas a sido completada exito.!! Nota: Se redireccionara a la pagina principal';
      return view('permitted.qualification.view_survey_rest', compact('message'));

      //return 'Encuesta completada con exito. El periodo de activacion de esta encuesta es hasta el dia '.$encrypted4;
    }

  }
  public function create(Request $request){
    $data_cifrada = $request->token_form;
    $data_comment= $request->message;

    $encrypted3 = Crypt::decryptString($data_cifrada);
    $array_data = explode("/", $encrypted3);
    $send_user = $array_data[0];
    $reg_email = $array_data[1];
    $count_p = $array_data[2];
    $id_preguntas = $array_data[3];
    $mes_enc = $array_data[4];
    $hoteles = $array_data[5];

    //$reg_email;

    $pos = strpos($hoteles, '&');
    if ($pos === false) {
      //Unico de hotel
    }
    else{
      $array_hoteles = explode("&", $hoteles);
      $array_id_preguntas= explode("&", $id_preguntas);

      echo count($array_hoteles).'<br>';
      for ($i=0; $i < count($array_hoteles) ; $i++) {
        $hotel=$array_hoteles[$i];
        echo 'ID_HOTEL='.$array_hoteles[$i].'<br>';
        for ($j=1; $j <=$count_p; $j++) {
            echo 'id_pregunta='.$array_id_preguntas[$j-1].'<br>';
            $pregunta=$array_id_preguntas[$j-1];
            $input= $request->get('radio'.$j);
            echo $input.'<br>';

            $new_qualification = new Qualification_result;
            $new_qualification->fecha=$mes_enc;
            $new_qualification->respuesta=$input;
            $new_qualification->preguntas_id=$pregunta;
            $new_qualification->hotels_id=$hotel;
            $new_qualification->save();
        }

        //Registrar comments
        if (!empty($data_comment)) {
          echo $data_comment.'<br>';
          $new_comment = new Comment;
          $new_comment->mes=$mes_enc;
          $new_comment->respuesta=$data_comment;
          $new_comment->hotels_id=$hotel;
          $new_comment->users_id=$send_user;
          $new_comment->save();
        }
      }
      //ACTUALIZAMOS ESTATUS
      $update_status = Encuesta_user::find($reg_email);
      $update_status->estatus_id = '2';
      $update_status->shell_estatus_id = Crypt::encryptString('2');;
      $update_status->save();
      return back();
    }
    //dd($array_data);
  }
}
