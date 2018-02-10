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

class SurveyController extends Controller
{
  public function index($user, $venium, $survey, $end, $status)
  {
    $encriptado_user = $user;
    $encriptado_venium = $venium;
    $encriptado_survey = $survey;
    $encriptado_end = $end;
    $encriptado_status = $status;

    $sin='user= 10<br>venium= 75<br>survey= 53<br>end= 2018-02-28<br>Status= 2';

    $verif = 'user= '.$encriptado_user.'<br>venium= '.$encriptado_venium.'<br>survey= '.$encriptado_survey.'<br>end= '.$encriptado_end.'<br>Status= '.$encriptado_status;

    // $encrypted1 = Crypt::encryptString($encriptado_user);
    // $encrypted2 = Crypt::encryptString($encriptado_venium);
    // $encrypted3 = Crypt::encryptString($encriptado_survey);
    // $encrypted4 = Crypt::encryptString('2018-02-28');
    // $encrypted5 = Crypt::encryptString($encriptado_status);

    $encrypted1 = Crypt::decryptString($encriptado_user);
    $encrypted2 = Crypt::decryptString($encriptado_venium);
    $encrypted3 = Crypt::decryptString($encriptado_survey);
    $encrypted4 = Crypt::decryptString($encriptado_end);
    $encrypted5 = Crypt::decryptString($encriptado_status);

    $verif2 = 'user= '.$encrypted1.'<br>venium= '.$encrypted2.'<br>survey= '.$encrypted3.'<br>end= '.$encrypted4.'<br>Status= '.$encrypted5;


    return $sin.'<br><br>'.$verif.'<br><br>'.$verif2;

    // $sin_encriptar =Crypt::decrypt($id);
  }
}
