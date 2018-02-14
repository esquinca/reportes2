<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class roguedevices extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'rougue:mes';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Comando para registrar la informacion de devices rogue';

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
      $zoneDirect_sql = Zonedirect_ip::select('ip','hotel_id', 'oid_id')->get();
      $contar_ip= count($zoneDirect_sql); //Cuento el tamaño del array anterior
      $boolean = 0;
      $var_sum_reg=1;
      Date::setLocale('en');
      for ($i=0; $i < $contar_ip; $i++) {
        $host=$zoneDirect_sql[$i]->ip;
        $hotel=$zoneDirect_sql[$i]->hotel_id;

        $boolean = $this->trySNMP($host);

        if ($boolean === 0){
          ${"snmp_a".$i} = $this->trySNMP_oid($host, '1.3.6.1.4.1.25053.1.2.2.1.1.4.1.1.1'); //Rogue device's MAC Address.
          ${"snmp_b".$i} = $this->trySNMP_oid($host, '1.3.6.1.4.1.25053.1.2.2.1.1.4.1.1.4'); //Radio channel.
          ${"snmp_c".$i} = $this->trySNMP_oid($host, '1.3.6.1.4.1.25053.1.2.2.1.1.4.1.1.3'); //Radio type.
          ${"snmp_d".$i} = $this->trySNMP_oid($host, '1.3.6.1.4.1.25053.1.2.2.1.1.4.1.1.2'); //SSID.
          $contar_act= count(${"snmp_a".$i});
          DB::beginTransaction();
          for ($j=0; $j < $contar_act-1; $j++) {
            $contar_param_1= count(${"snmp_a".$i});
            $contar_param_2= count(${"snmp_b".$i});
            $contar_param_3= count(${"snmp_c".$i});
            $contar_param_4= count(${"snmp_d".$i});
            if ( empty($contar_param_1) || empty($contar_param_2) || empty($contar_param_3)  || empty($contar_param_4)) {
              echo '/Error encontrado';
            }
            else {
              //Para obtener la MAC Address.
              ${"snmp_aa".$i}= explode(': ', ${"snmp_a".$i} [key(${"snmp_a".$i})]);
              next(${"snmp_a".$i}); //Este es para que avance la key en el array

              //Para obtener el radio channel
              ${"snmp_ab".$i}= explode(': ', ${"snmp_b".$i} [key(${"snmp_b".$i})]);
              next(${"snmp_b".$i}); //Este es para que avance la key en el array

              //Para obtener el radio type
              ${"snmp_ac".$i}= explode(': ', ${"snmp_c".$i} [key(${"snmp_c".$i})]);
              next(${"snmp_c".$i}); //Este es para que avance la key en el array

              //Para obtener el SSID
              ${"snmp_ad".$i}= explode(': ', ${"snmp_d".$i} [key(${"snmp_d".$i})]);
              next(${"snmp_d".$i}); //Este es para que avance la key en el array

              echo $parmt_a = '/-Mac: '.${"snmp_aa".$i}[1];
              echo $parmt_b = '-Radio:'.${"snmp_ab".$i}[1];
              echo $parmt_c = '-Type: '.${"snmp_ac".$i}[1];
              echo $parmt_d = '-SSID: '.${"snmp_ad".$i}[1].'/';
              echo $Mesitho =Date::now()->format('F Y');
              echo '/';
              echo Date::now()->format('Y-m-d');
              echo '/';
              echo $hotel.'/';                           
            }
          }
          DB::commit();
        }
        else {
          //----------------
        }


      }
    }
    public function trySNMP($ip)
    {
      $boolean = 0;
      $session = new SNMP(SNMP::VERSION_2C, $ip, "public");
      try {
        $res = $session->walk('1.3.6.1.4.1.25053.1.2.2.1.1.4.1.1.1'); //Rogue device's MAC Address.
      } catch (\Exception $e) {
        if ( $session->getErrno() == SNMP::ERRNO_TIMEOUT ) {
          $boolean = 1;
        }
        return $boolean;
      }
      $session->close();
      return $boolean;
    }
}
