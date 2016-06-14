<?php namespace WendelMoreira\Correios;

use Exception;
use SoapClient;

class CorreiosService extends CorreiosConfiguration
{
    private $function;
    private $webService;
    private $commonParameters;
    private $parameters;
    private $paramsWs;

    private $functionsWeb1 = [
        'consultaCEP'
    ];

    public function  __call($function, $arguments)
    {
        $this->commonParameters = [
            'codAdministrativo' => self::$codAdministrativo,
            'usuario' => self::$usuario,
            'senha' => self::$senha,
        ];
        $this->parameters = $arguments;
        $this->function = $function;

        if (in_array($function, $this->functionsWeb1))
            $this->webService = 'https://apps.correios.com.br/SigepMasterJPA/AtendeClienteService/AtendeCliente?wsdl';

        $this->function = $function;

        return $this->getWebservice();
    }

    public static function setConfig($value)
    {
        self::$codAdministrativo = $value['codAdministrativo'] ?: null;
        self::$usuario = $value['usuario'] ?: null;
        self::$senha = $value['senha'] ?: null;
        return true;
    }

    public function getWebservice()
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