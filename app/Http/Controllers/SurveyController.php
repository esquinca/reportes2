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

class SurveyController extends Controller
{
  public function index($user, $venium, $survey, $end, $status)
  {
    $encriptado_user = $user;
    $encriptado_venium = $venium;
    $encriptado_survey = $survey;
    $encriptado_end = $end;
    $encriptado_status = $status;

    $encrypted2 = Crypt::decryptString($encriptado_venium);
    $encrypted3 = Crypt::decryptString($encriptado_survey);
    $encrypted4 = Crypt::decryptString($encriptado_end);

    $enc_verificar = Encuesta_user::where('shell_hotel_id', '=', $encriptado_venium)
    ->where('shell_user_id', '=', $encriptado_user)
    ->where('shell_encuesta_id', '=', $encriptado_survey)
    ->where('shell_estatus_id', '=', $encriptado_status)
    ->where('shell_fecha_fin', '=', $encriptado_end)
    ->where('estatus_id', '=', 1)
    ->count();

    $sacar_preg = Encuesta::find($encrypted3)->preguntas()->where('encuesta_id', $encrypted3)->get();

    // dd($sacar_preg);


    if ($enc_verificar == '1') {

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
        return view('permitted.qualification.view_survey',compact('encrypted2', 'encrypted3', 'encrypted4', 'sacar_preg'));
        // for ($i=0; $i < count($array_hotel) ; $i++) {
        //   echo $array_hotel[$i].'<br>';
        // }
        // echo 'varios hoteles';
        // echo'<br>';
        // dd($array_hotel);
      }
      //return view('permitted.qualification.view_survey');
    }
    else {
      //return 'Encuesta completada con exito. El periodo de activacion de esta encuesta es hasta el dia '.$encrypted4;
    }






    // $cadena = "uno,dos,tres,cuatro,cinco";
    // $array = explode(",", $cadena);
    // echo "<br><br>El número de elementos en el array es: " . count($array);
    // dd($array);



    // $encriptado_user = '8';
    // $encriptado_venium = '1&5&3';
    // $encriptado_survey = '1';
    // $encriptado_end = '2018-02-28';
    // $encriptado_status = '1';

    //$sin='user= 8<br>venium= 1&5&3<br>survey= 1<br>end= 2018-02-28<br>Status= 1';

    //$verif = 'user= '.$encriptado_user.'<br>venium= '.$encriptado_venium.'<br>survey= '.$encriptado_survey.'<br>end= '.$encriptado_end.'<br>Status= '.$encriptado_status;
    //
    // $encrypted1 = Crypt::encryptString($encriptado_user);
    // $encrypted2 = Crypt::encryptString($encriptado_venium);
    // $encrypted3 = Crypt::encryptString($encriptado_survey);
    // $encrypted4 = Crypt::encryptString($encriptado_end);
    // $encrypted5 = Crypt::encryptString($encriptado_status);

    // $encrypted1 = Crypt::decryptString($encriptado_user);
    // $encrypted2 = Crypt::decryptString($encriptado_venium);
    // $encrypted3 = Crypt::decryptString($encriptado_survey);
    // $encrypted4 = Crypt::decryptString($encriptado_end);
    // $encrypted5 = Crypt::decryptString($encriptado_status);



    //$verif2 = 'user= '.$encrypted1.'<br>venium= '.$encrypted2.'<br>survey= '.$encrypted3.'<br>end= '.$encrypted4.'<br>Status= '.$encrypted5;


  //  return $sin.'<br><br>'.$verif.'<br><br><br><br>'.$enc_verificar;
    // return $sin.'<br><br>'.$verif.'<br><br>'.$verif2.'<br><br>';


    // $sin_encriptar =Crypt::decrypt($id);

    /* Datos prueba
    user= 8
    venium= 1&5&3
    survey= 1
    end= 2018-02-28
    Status= 1

    user= 8
    venium= 1&5&3
    survey= 1
    end= 2018-02-28
    Status= 1

    user= eyJpdiI6IlloMlEraE9taEtSazcxR2ZCUjJCUUE9PSIsInZhbHVlIjoiMmJhTGkyWFkrK0dSZHphM2JxRlJDQT09IiwibWFjIjoiMWE2YTFlZWU2MjIyN2NiMTRiN2U4OGQxYTEzNWJiZDZkZWYxY2M0ZWUwODFmNDVkMzE4ZmJkYWI5OTZmZTYwMSJ9
    venium= eyJpdiI6IjIwSTd3amk4Tzg0bTRORUlCRXE0Nnc9PSIsInZhbHVlIjoiN09vaDJmbUZxUldKRmorS0plajBSZz09IiwibWFjIjoiYjkxODM5YmNkYmFjMWMyMDdmOGU4NDRkYmQ1MTQ4ZGM5ODQ3ODAxYmZhZmY1NmE1MTg2MjJkMjRmNGU5OWIzNSJ9
    survey= eyJpdiI6IlRDejBuSkk1MFJOWDFnN0crMFRKNGc9PSIsInZhbHVlIjoiZERLV0JQUW9odGdxaTZlUFVkU01vUT09IiwibWFjIjoiY2VlMzg2MDhjNDFhOGZlYmJkNzYyNWI4OTQ3MThiNWE4NjNmM2JhMzEzZTA2YzNmZThlNGU2ZWNlMjc3MGM4OCJ9
    end= eyJpdiI6InBQQ0RIY04rc0tWb2ZQYVUxRzY5NGc9PSIsInZhbHVlIjoiY0V3UCtUR1RWT0plcDFQXC85XC9cL3ZBQT09IiwibWFjIjoiMzg3YTdiNmZhYzAyZWVkYjYzYTNiMWQyZDY3OGM0Y2UyNTkyYzIyZGI3YThhOWYzMWNmZGNhMjk2MDNmNDhhNyJ9
    Status= eyJpdiI6InFNVmJnczU0bUJIb3hqQkRHOWh1amc9PSIsInZhbHVlIjoiXC9IT2g4M2lsbVFwbjkxK0ZqSTZvNkE9PSIsIm1hYyI6ImNhZmIyNTIxMmNiMWU4YWYxNDg2MmYzNWIyYmVhOGNhMTU2MmM2YWVkZTM0YjdhNWIyMmQ2Y2FhOGI0MmQ2OGUifQ==


    http://localhost:8000/eyJpdiI6IlloMlEraE9taEtSazcxR2ZCUjJCUUE9PSIsInZhbHVlIjoiMmJhTGkyWFkrK0dSZHphM2JxRlJDQT09IiwibWFjIjoiMWE2YTFlZWU2MjIyN2NiMTRiN2U4OGQxYTEzNWJiZDZkZWYxY2M0ZWUwODFmNDVkMzE4ZmJkYWI5OTZmZTYwMSJ9/eyJpdiI6IjIwSTd3amk4Tzg0bTRORUlCRXE0Nnc9PSIsInZhbHVlIjoiN09vaDJmbUZxUldKRmorS0plajBSZz09IiwibWFjIjoiYjkxODM5YmNkYmFjMWMyMDdmOGU4NDRkYmQ1MTQ4ZGM5ODQ3ODAxYmZhZmY1NmE1MTg2MjJkMjRmNGU5OWIzNSJ9/eyJpdiI6IlRDejBuSkk1MFJOWDFnN0crMFRKNGc9PSIsInZhbHVlIjoiZERLV0JQUW9odGdxaTZlUFVkU01vUT09IiwibWFjIjoiY2VlMzg2MDhjNDFhOGZlYmJkNzYyNWI4OTQ3MThiNWE4NjNmM2JhMzEzZTA2YzNmZThlNGU2ZWNlMjc3MGM4OCJ9/eyJpdiI6InBQQ0RIY04rc0tWb2ZQYVUxRzY5NGc9PSIsInZhbHVlIjoiY0V3UCtUR1RWT0plcDFQXC85XC9cL3ZBQT09IiwibWFjIjoiMzg3YTdiNmZhYzAyZWVkYjYzYTNiMWQyZDY3OGM0Y2UyNTkyYzIyZGI3YThhOWYzMWNmZGNhMjk2MDNmNDhhNyJ9/eyJpdiI6InFNVmJnczU0bUJIb3hqQkRHOWh1amc9PSIsInZhbHVlIjoiXC9IT2g4M2lsbVFwbjkxK0ZqSTZvNkE9PSIsIm1hYyI6ImNhZmIyNTIxMmNiMWU4YWYxNDg2MmYzNWIyYmVhOGNhMTU2MmM2YWVkZTM0YjdhNWIyMmQ2Y2FhOGI0MmQ2OGUifQ==
    */
  }
}
