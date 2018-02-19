<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use SNMP;
use Mail;
use App\User; //Importar el modelo eloquent
use App\Hotel; //Importar el modelo eloquent
use App\Zonedirect_ip; //Importar el modelo eloquent
use App\Mail\CmdAlerts;
use Jenssegers\Date\Date;

class estadoserver extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'estado:server';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Comando para verificar el estado de las ip publicas';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $zoneDirect_sql= Zonedirect_ip::select('ip','hotel_id', 'oid_id')->get(); //Retorna un array stdClass Object
        $contar_ip= count($zoneDirect_sql); //Cuento el tamaño del array anterior
        $boolean = 0;
        //Creo un ciclo for para recorrer las posiciones del array
        for ($i=0; $i < $contar_ip ; $i++) {
          $host=$zoneDirect_sql[$i]->ip;
          $hotel=$zoneDirect_sql[$i]->hotel_id;
          $email_user = Hotel::find($hotel);
          $total_user_x_hotel =  count($email_user->usuarios);

          $boolean = $this->trySNMP($host);
          if ($boolean === 0){
              echo "Ping successful!";
          }
          else {
            echo "Ping unsuccessful!";
            /*-------------------------VERIFICACIONES DE USUARIOS-----------------------------------------*/
            if ($total_user_x_hotel >= '1' ) {//Mas de un usuario asignado al hotel.
              //echo 'mayor'.$total_user_x_hotel;
              for ($j=0; $j <$total_user_x_hotel; $j++) {
                $it_name = $email_user->usuarios[$j]->name;
                $it_correo = $email_user->usuarios[$j]->email;
                //$it_correos= 'acauich@sitwifi.com';
                $asunt = 'Acceso denegado';
                Date::setLocale('es');
                $date = Date::now()->format('l j F Y H:i:s');
                /*Actualizo estatus a inactivo*/
                //echo '/'.$hotel.'-'.$host.'/';
                Zonedirect_ip::where('hotel_id', $hotel)->where('ip', $host)->update(['status' => 0]);
                /*Actualizo estatus a inactivo*/
                $data = [
                  'asunto' => $asunt,
                  'ip' => $host,
                  'hotel' => $email_user->Nombre_hotel,
                  'nombre' => $it_name,
                  'mensaje' => 'Favor de revisar el motivo de la no conexion y de capturar sus datos pertenecientes a la fecha del ',
                  'fecha' => $date
                ];
                //Mail::to($it_correo)->bcc('alonsocauichv1@gmail.com')->send(new CmdAlerts($data));
                Mail::to($it_correo)->send(new CmdAlerts($data));
              }
            }

            /*-------------------------VERIFICACIONES DE USUARIOS-----------------------------------------*/
          }

        }
    }

    public function trySNMP($ip)
    {
      $boolean = 0;
      $session = new SNMP(SNMP::VERSION_2C, $ip, "public");
      try {
        $res = $session->walk('1.3.6.1.4.1.25053.1.2.2.1.1.2.1.1.4'); //Model name
      } catch (\Exception $e) {
        $boolean = $session->getErrno() == SNMP::ERRNO_TIMEOUT;
        return $boolean;
      }
      $session->close();
      return $boolean;
    }
}
