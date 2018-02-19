<?php
namespace App\Console\Commands;
use Illuminate\Console\Command;
use DB;
use SNMP;
use Mail;
use App\User; //Importar el modelo eloquent
use App\Hotel; //Importar el modelo eloquent
use App\Zonedirect_ip; //Importar el modelo eloquent
use App\Gbxdia; //Importar el modelo eloquent
use App\Oid;
use App\Mail\CmdAlerts;
use Jenssegers\Date\Date;
class bytesxdia extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'bytes:dia';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Comando para registrar los bytes transmitidos';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }
    public function trySNMP($ip)
    {
      $boolean = 0;
      $session = new SNMP(SNMP::VERSION_2C, $ip, "public");
      try {
        $res = $session->walk('1.3.6.1.4.1.25053.1.2.1.1.1.15.9'); //Transmitted Bytes
      } catch (\Exception $e) {
        if ( $session->getErrno() == SNMP::ERRNO_TIMEOUT ) {
          $boolean = 1;
        }
        return $boolean;
      }
      $session->close();
      return $boolean;
    }
    public function trySNMP_oid($ip, $oid)
    {
      $res = array();
      $boolean = 0;
      $session = new SNMP(SNMP::VERSION_2C, $ip, "public");
      try {
        $res = $session->walk($oid);
      } catch (\Exception $e) {
        if ( $session->getErrno() == SNMP::ERRNO_TIMEOUT ) {
          $res = array();
        }
        return $res;
      }
      $session->close();
      return $res;
    }
    public function envio_mail($hotel, $host, $asunt, $mensaje){
      $email_user = Hotel::find($hotel);
      $total_user_x_hotel =  count($email_user->usuarios);
      /*-------------------------VERIFICACIONES DE USUARIOS-----------------------------------------*/
      if ($total_user_x_hotel >= '1' ) {//Mas de un usuario asignado al hotel.
        for ($j=0; $j <$total_user_x_hotel; $j++) {
          $it_name = $email_user->usuarios[$j]->name;
          $it_correo = $email_user->usuarios[$j]->email;
          $it_correos= 'acauich@sitwifi.com';
          // $asunt = 'Top 5 de Ap&#8216;s';
          $data = [
            'asunto' => $asunt,
            'ip' => $host,
            'hotel' => $email_user->Nombre_hotel,
            'nombre' => $it_name,
            'mensaje' => $mensaje,
            'fecha' => Date::now()->format('l j F Y H:i:s')
          ];
          //Mail::to($it_correos)->bcc('alonsocauichv1@gmail.com')->send(new CmdAlerts($data));
          Mail::to($it_correo)->send(new CmdAlerts($data));
        }
      }
      /*-------------------------VERIFICACIONES DE USUARIOS-----------------------------------------*/
    }
    public function operacionempty($hotel, $nzd, $host, $ndias)
    {
      Date::setLocale('en');
      //Gbxdia::truncate();

      $consultar_ult_reg = Gbxdia::select('Fecha','ConsumoReal','days')
                            ->where('Captura', 1)
                            ->where('hotels_id', $hotel)
                            ->where('ZD', $nzd)
                            ->where('Fecha', Date::now()->format('Y-m-d'))
                            ->orderBy('id', 'desc')
                            ->take(1)
                            ->get();
      if ($consultar_ult_reg->isEmpty()) {
        echo '-/Entramos y registramos/';
        $consultar_ult_reg = Gbxdia::select('Fecha','ConsumoReal','days')
        ->where('Captura', 1)
        ->where('hotels_id', $hotel)
        ->where('ZD', $nzd)
        ->where('days', '<>', NULL)
        ->orderBy('id', 'desc')
        ->take(1)
        ->get();
        $fecha_anio_act = Date::now()->format('Y');
        $fecha_mes_act = Date::now()->format('m');
        //dd($consultar_ult_reg);
        $oid_value = '1.3.6.1.4.1.25053.1.2.1.1.1.15.9';
        $consumoreal_sm = $this->trySNMP_oid($host, $oid_value);//Consults Transmitted Bytes
        $data_consumo =explode(': ', $consumoreal_sm [key($consumoreal_sm)]) ;
        $consumoreal = $data_consumo[1];
        if ($consultar_ult_reg->isEmpty()) { // No existe el ultimo registro
          if ($ndias <= 1) { //Aprobado por que cumple mas de 15 hrs
            $GBxDIA_cap = new Gbxdia;
            $GBxDIA_cap->CantidadBytes= $data_consumo[1];
            $GBxDIA_cap->ConsumoReal= $data_consumo[1];
            $GBxDIA_cap->Fecha= Date::now()->format('Y-m-d');
            $GBxDIA_cap->Mes= Date::now()->format('F Y');
            $GBxDIA_cap->hotels_id= $hotel;
            $GBxDIA_cap->Captura= '1';
            $GBxDIA_cap->ZD= $nzd;
            $GBxDIA_cap->days= $ndias;
            $GBxDIA_cap->save();
          }
          else{ //Tiene un dia pero no tiene registro anterior entonces
            $asunt="Consumo GB..!!!";
            $mensaje= "No se ha registrado el consumo de GB, hasta que se reinicie el ZD";
            $this->envio_mail($hotel,$host, $asunt, $mensaje);
          }
        }
        else { // Si hay registro del dia anterior
          $cont_ult_reg_fecha= $consultar_ult_reg[0]->Fecha;
          //echo '/';
          $cont_ult_reg_consumo = $consultar_ult_reg[0]->ConsumoReal;
          //echo '/';
          $cont_ult_reg_days = $consultar_ult_reg[0]->days;
          //echo '/';
          $cont_ult_reg_f_year = date("Y", strtotime($cont_ult_reg_fecha));
          //echo '/';
          $cont_ult_reg_f_month = date("m", strtotime($cont_ult_reg_fecha));

          if ($fecha_anio_act == $cont_ult_reg_f_year) { //Si el ultimo año registrado es igual al año actual
            if ($fecha_mes_act > $cont_ult_reg_f_month) { //Si el mes actual es mayor al ulti. reg de bd. Entonces avanzamos un mes 1 (Pasamos a otro mes)
              if ($ndias <= 1) { //Si ndias es menor o igual a 1 registramos directo
                $GBxDIA_cap = new Gbxdia;
                $GBxDIA_cap->CantidadBytes= $data_consumo[1];
                $GBxDIA_cap->ConsumoReal= $data_consumo[1];
                $GBxDIA_cap->Fecha= Date::now()->format('Y-m-d');
                $GBxDIA_cap->Mes= Date::now()->format('F Y');
                $GBxDIA_cap->hotels_id= $hotel;
                $GBxDIA_cap->Captura= '1';
                $GBxDIA_cap->ZD= $nzd;
                $GBxDIA_cap->days= $ndias;
                $GBxDIA_cap->save();
              }
              else { //Si es mayor a uno
                if($cont_ult_reg_days < $ndias){ //Si el ultimo registro de dias es menor a ndias(No se a reiniciado zd)
                  if ($consumoreal < $cont_ult_reg_consumo) {
                    $NcantidadBytes=$consumoreal;
                  }
                  else{
                    $NcantidadBytes=$consumoreal-$cont_ult_reg_consumo;
                  }
                  $GBxDIA_cap = new Gbxdia;
                  $GBxDIA_cap->CantidadBytes= $NcantidadBytes;
                  $GBxDIA_cap->ConsumoReal= $consumoreal;
                  $GBxDIA_cap->Fecha= Date::now()->format('Y-m-d');
                  $GBxDIA_cap->Mes= Date::now()->format('F Y');
                  $GBxDIA_cap->hotels_id= $hotel;
                  $GBxDIA_cap->Captura= '1';
                  $GBxDIA_cap->ZD= $nzd;
                  $GBxDIA_cap->days= $ndias;
                  $GBxDIA_cap->save();
                }
              }
            }
            if ($fecha_mes_act == $cont_ult_reg_f_month){//Si el mes actual es igual al ulti. reg de bd. Entonces estamos en el mismo mes
              if ($ndias <= 1) { //Si ndias es menor o igual a 1 registramos directo
                $GBxDIA_cap = new Gbxdia;
                $GBxDIA_cap->CantidadBytes= $consumoreal;
                $GBxDIA_cap->ConsumoReal= $consumoreal;
                $GBxDIA_cap->Fecha= Date::now()->format('Y-m-d');
                $GBxDIA_cap->Mes= Date::now()->format('F Y');
                $GBxDIA_cap->hotels_id= $hotel;
                $GBxDIA_cap->Captura= '1';
                $GBxDIA_cap->ZD= $nzd;
                $GBxDIA_cap->days= $ndias;
                $GBxDIA_cap->save();
              }
              else {
                if ($cont_ult_reg_days < $ndias) {
                  if ($consumoreal < $cont_ult_reg_consumo) {
                    $NcantidadBytes=$consumoreal;
                  }
                  else {
                    $NcantidadBytes=$consumoreal-$cont_ult_reg_consumo;
                  }
                }
                $GBxDIA_cap = new Gbxdia;
                $GBxDIA_cap->CantidadBytes= $NcantidadBytes;
                $GBxDIA_cap->ConsumoReal= $consumoreal;
                $GBxDIA_cap->Fecha= Date::now()->format('Y-m-d');
                $GBxDIA_cap->Mes= Date::now()->format('F Y');
                $GBxDIA_cap->hotels_id= $hotel;
                $GBxDIA_cap->Captura= '1';
                $GBxDIA_cap->ZD= $nzd;
                $GBxDIA_cap->days= $ndias;
                $GBxDIA_cap->save();
              }
            }
          }
          if ($fecha_anio_act > $cont_ult_reg_f_year) { //Si el ultimo año registrado es menor al año actual (Cambiamos de año)
            if ($cont_ult_reg_f_month > $fecha_mes_act) {//Si el mes registrado es mayor al mes actual
              if ($ndias <= 1) {
                $GBxDIA_cap = new Gbxdia;
                $GBxDIA_cap->CantidadBytes= $consumoreal;
                $GBxDIA_cap->ConsumoReal= $consumoreal;
                $GBxDIA_cap->Fecha= Date::now()->format('Y-m-d');
                $GBxDIA_cap->Mes= Date::now()->format('F Y');
                $GBxDIA_cap->hotels_id= $hotel;
                $GBxDIA_cap->Captura= '1';
                $GBxDIA_cap->ZD= $nzd;
                $GBxDIA_cap->days= $ndias;
                $GBxDIA_cap->save();
              }
              else {
                if ($cont_ult_reg_days < $ndias) {
                  if ($consumoreal<$cont_ult_reg_consumo) {
                    $NcantidadBytes=$consumoreal;
                  }
                  else {
                    $NcantidadBytes=$consumoreal-$cont_ult_reg_consumo;
                  }
                }
                $GBxDIA_cap = new Gbxdia;
                $GBxDIA_cap->CantidadBytes= $NcantidadBytes;
                $GBxDIA_cap->ConsumoReal= $consumoreal;
                $GBxDIA_cap->Fecha= Date::now()->format('Y-m-d');
                $GBxDIA_cap->Mes= Date::now()->format('F Y');
                $GBxDIA_cap->hotels_id= $hotel;
                $GBxDIA_cap->Captura= '1';
                $GBxDIA_cap->ZD= $nzd;
                $GBxDIA_cap->days= $ndias;
                $GBxDIA_cap->save();
              }
            }
            echo '*/Nuevo año/';
          }
        }
      }
      else {
        echo '-/dia registrado/';
      }
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
      $zoneDirect_sql = Zonedirect_ip::select('id','ip','hotel_id', 'oid_id')->where('hotel_id', '18')->get();
      $contar_ip= count($zoneDirect_sql); //Cuento el tamaño del array anterior
      $boolean = 0;
      //Gbxdia::truncate();
      Date::setLocale('en');
      //Creo un ciclo for para recorrer las posiciones del array
      for ($i=0; $i < $contar_ip; $i++) {
        $host=$zoneDirect_sql[$i]->ip;
        $hotel=$zoneDirect_sql[$i]->hotel_id;
        $nzd=$zoneDirect_sql[$i]->id;

        /*Contar los usuarios*/
        $email_user = Hotel::find($hotel);
        $total_user_x_hotel =  count($email_user->usuarios);
        /*Fin Contar los usuarios*/
        $boolean = $this->trySNMP($host);
        $ndias=0;

        if ($boolean === 0){
          /*Encontrar la cadena del oid del uptime*/
          $uptime_id=$zoneDirect_sql[$i]->oid_id;
          $find_uptime = Oid::find($uptime_id);
          $oid_value = $find_uptime->oid;
          $oid_respuesta = $this->trySNMP_oid($host, $oid_value);//Consultamos uptime
          if (!empty($oid_respuesta)) {
            $oid_respuesta_array= explode(': ', $oid_respuesta [key($oid_respuesta)]) ;
            // $RespondeUptime= $oid_respuesta_array[1];
            //$RespondeUptime='(22331665) 13:42:41.37';
             //$RespondeUptime='(66957) 11:19:09.57';
            $RespondeUptime='(26377264) 1 days, 1:16:12.64';
            // var_dump($RespondeUptime);
            $buscarday = strpos($RespondeUptime, 'day');
            if ($buscarday === false) {
              echo "La palabra day no fue encontrada";
              $separarbuscarday = explode(" ", $RespondeUptime);
              $separarbuscarhrs = explode(":", $separarbuscarday[1]);
              $hora_extraida = $separarbuscarhrs[0];
              if ($hora_extraida < 10) {
                 /*-------------------------VERIFICACIONES DE USUARIOS-----------------------------------------*/
                 if ($total_user_x_hotel >= '1' ) { //Mas de un usuario asignado al hotel.
                   for ($j=0; $j <$total_user_x_hotel; $j++) {
                     $it_name = $email_user->usuarios[$j]->name;
                     $it_correo = $email_user->usuarios[$j]->email;
                     $it_correos= 'acauich@sitwifi.com';
                     $asunt = 'Consumo GB';
                     $data = [
                       'asunto' => $asunt,
                       'ip' => $host,
                       'hotel' => $email_user->Nombre_hotel,
                       'nombre' => $it_name,
                       'mensaje' => 'No es posible registrar un consumo de menos de 10 hora. Favor de capturar el consumo de manera manual en el sistema de reportes. Los datos a capturar son pertenecientes a la fecha del ',
                       'fecha' => Date::now()->format('l j F Y H:i:s')
                     ];
                     //Mail::to($it_correos)->bcc('alonsocauichv1@gmail.com')->send(new CmdAlerts($data));
                     Mail::to($it_correo)->send(new CmdAlerts($data));
                   }
                 }
                 /*-------------------------VERIFICACIONES DE USUARIOS-----------------------------------------*/
              }
              else {
                 echo $msj2= "Tiene mas de 10 horas";
                 $this->operacionempty($hotel, $nzd, $host, $ndias);
              }
            }
            else {
              echo "La palabra day si fue encontrada";
              $separarbuscarday = explode(" ", $RespondeUptime);
              $dias_extraida = $separarbuscarday[1];
              $ndias = $dias_extraida;
              $this->operacionempty($hotel, $nzd, $host, $ndias);
            }
          }
          else {
            echo 'OID Mal asignado';
          }
          /*Fin Encontrar la cadena del oid del uptime*/
        }
        else {
          /*-------------------------VERIFICACIONES DE USUARIOS-----------------------------------------*/
          if ($total_user_x_hotel >= '1' ) { //Mas de un usuario asignado al hotel.
            for ($j=0; $j <$total_user_x_hotel; $j++) {
              $it_name = $email_user->usuarios[$j]->name;
              $it_correo = $email_user->usuarios[$j]->email;
              $it_correos= 'acauich@sitwifi.com';
              $asunt = 'Consumo GB';
              $data = [
                'asunto' => $asunt,
                'ip' => $host,
                'hotel' => $email_user->Nombre_hotel,
                'nombre' => $it_name,
                'mensaje' => 'No es posible establecer comunicación con el puerto asignado. Favor de capturar el consumo de manera manual en el sistema de reportes. Los datos a capturar son pertenecientes a la fecha del ',
                'fecha' => Date::now()->format('l j F Y H:i:s')
              ];
              //Mail::to($it_correos)->bcc('alonsocauichv1@gmail.com')->send(new CmdAlerts($data));
              Mail::to($it_correo)->send(new CmdAlerts($data));
            }
          }
          /*-------------------------VERIFICACIONES DE USUARIOS-----------------------------------------*/

        }

      }
    }
}