<?php namespace Correios_;

use Exception;
use SoapClient;

class CorreiosService
{
    private $function;
    private $webService;
    private $commonParameters;
    private $parameters;
    private $paramsWs;

    public function  __call($function, $arguments)
    {
        $this->paramsWs = array_merge($this->commonParameters, $this->parameters);

        try
        {
            $clientWS = new SoapClient($this->webService, [
                'trace' => true,
                'exceptions' => true,
                'compression' => SOAP_COMPRESSION_ACCEPT | SOAP_COMPRESSION_GZIP,
                'connection_timeout' => 10,
            ]);
            $function = $this->function;
            $resultWS = $clientWS->$function($this->paramsWs);

            return $resultWS;

        }
        catch (Exception $e)
        {
            return $e;
        }
    }
}