<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;

use SoapClient;

class GuestToolsController extends Controller
{

public $xmlreq=<<<XML
<?xml version="1.0" encoding="utf-8"?><soap:Envelope xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema"><soap:Body><Post_ObtenerInfoRoomPorHabitacion xmlns="http://localhost/xmlschemas/postserviceinterface/16-07-2009/"><RmroomRequest xmlns="http://localhost/pr_xmlschemas/hotel/01-03-2006/RmroomRequest.xsd"><Rmroom><hotel xmlns="http://localhost/pr_xmlschemas/hotel/01-03-2006/Rmroom.xsd"></hotel><room xmlns="http://localhost/pr_xmlschemas/hotel/01-03-2006/Rmroom.xsd"></room></Rmroom><rooms /></RmroomRequest></Post_ObtenerInfoRoomPorHabitacion></soap:Body></soap:Envelope>
XML;

	/**
	* Show the application guest tools
	*
	* @return \Illuminate\Http\Response
	*/
	public function index()
	{
		return view('permitted.tools.guest_tools');
	}

	public function checkGuest(Request $request)
	{
		$hotel_code = $request->input('hotelCode');

		$room = $request->input('roomNum');

		if ($hotel_code === 'PL' || $hotel_code === 'CZ') {
		    $queryPL = DB::connection('sunrisezq')->table('authtoken')->select([
		        'username',
		        'createdate',
		        'expiration'
		    ])->where('username', 'like', '%'.$room.'%')->get();

		    return json_encode($queryPL);
		}else{
		    $queryJP = DB::connection('jamaicazq')->table('authtoken')->select([
		        'username',
		        'createdate',
		        'expiration'
		    ])->where('username', 'like', '%'.$room.'%')->get();

		    return json_encode($queryJP);
		}
	}

    public function checkWebSer(Request $request)
    {

        $hotel_code = $request->input('hotelCode');
        $room = $request->input('roomNum');

        $XMLquery = $this->replaceXML($hotel_code, $room);
        $XMLresponse = $this->getInfoxHab($XMLquery);
        $XMLresponse = str_replace('xmlns=', 'ns=', $XMLresponse);
        $XMLsimple = simplexml_load_string($XMLresponse);


        foreach ($XMLsimple->xpath('//InfoRoomResponse') as $InfoRoomResponse) {
            $HasError = (string)$InfoRoomResponse->HasErrors;
            $ErrorMSG = (string)$InfoRoomResponse->ExceptionInfo->Message;
        }

        if ($HasError == "false") {
            foreach ($XMLsimple->xpath('//RmFolio') as $RmFolio) {
                $ApeXML = (string)$RmFolio->Rmfolio->last_name;
                $NombreXML = (string)$RmFolio->Rmfolio->first_name;
                $nochesXML = (string)$RmFolio->Rmfolio->nights;
            }
            $results = array(
                "errores" => $HasError,
                "apellido" => $ApeXML,
                "nombre" => $NombreXML,
                "noches" => $nochesXML
            );

            return json_encode($results);
        }else{
            $resultsErr = array(
                "errores" => $HasError,
                "mensaje" => $ErrorMSG
            );

            return json_encode($resultsErr);
        }

    }

    public function replaceXML($hotelcode, $roominfo){
        $xmlinfo = $this->xmlreq;

        $stringXML = str_replace('xmlns=', 'ns=', $xmlinfo);

        $xmltest = simplexml_load_string($stringXML);

        foreach ($xmltest->xpath('//Rmroom') as $Rmroom) {
            $Rmroom->hotel = $hotelcode;// <---- Agregar la variable dinamica de Hoteles!
            $Rmroom->room = $roominfo; // <---- Aqui es donde va la variable dinamica
        }
        $XMLenString = $xmltest->asXML();
        $XMLreq2 = str_replace('ns=', 'xmlns=', $XMLenString);

        return $XMLreq2;
    }

    public function getInfoxHab($xml){
        $wsdlloc = "http://api.palaceresorts.com/TigiServiceInterface/ServiceInterface.asmx?wsdl";
        $accion = "http://localhost/xmlschemas/postserviceinterface/16-07-2009/Post_ObtenerInfoRoomPorHabitacion";
        $option=array('trace'=>1);

        try {
            $soapClient = new SoapClient("http://api.palaceresorts.com/TigiServiceInterface/ServiceInterface.asmx?wsdl", $option);

            $resultRequest = $soapClient->__doRequest($xml, $wsdlloc, $accion, 0);

            $soapClient->__last_request = $xml;
            //var_dump($resultRequest);
            //echo "  -REQUEST:\n" . htmlentities($soapClient->__getLastRequest()) . "\n";
            unset($soapClient);
            return $resultRequest;

        } catch (SoapFault $exception) {
            echo "  -REQUEST:\n" . htmlentities($soapClient->__getLastRequest()) . "\n";
            echo $exception->getMessage();
            unset($soapClient);
            return FALSE;
        }
    }

}
