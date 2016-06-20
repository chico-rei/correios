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

    private $functionsWeb2 = [
        'CalcPrecoPrazo',
        'cServico',
        'CalcPrecoPrazoData',
        'CalcPrecoPrazoRestricao',
        'CalcPreco',
        'CalcPrecoData',
        'CalcPrazo',
        'CalcPrecoFAC',
    ];

    private $functionsWeb3 = [
        'solicitarPostagemReversa'
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
        elseif (in_array($function, $this->functionsWeb2))
        {
            $this->commonParameters = [
                'nCdEmpresa' => self::$codAdministrativo,
                'sDsSenha' => self::$senha,
                'nCdServico' => $arguments['nCdServico'],
                'sCdMaoPropria' => $arguments['sCdMaoPropria'],
                'sCdAvisoRecebimento' => $arguments['sCdAvisoRecebimento'],
                'sCepOrigem' => self::$cepOrigem,
            ];

            $this->webService = 'http://ws.correios.com.br/calculador/CalcPrecoPrazo.asmx?WSDL';
        }elseif (in_array($function, $this->functionsWeb3)) {
            $this->commonParameters = [
                'codAdministrativo' => self::$codAdministrativo,
                'codigo_servico' => self::$codigo_servico,
                'cartao' => self::$cartao,
                'destinatario' => [
                    'nome' => self::$nome,
                    'logradouro' => self::$logradouro,
                    'numero' => self::$numero,
                    'complemento' => self::$complemento,
                    'bairro' => self::$bairro,
                    'referencia' => self::$referencia,
                    'cidade' => self::$cidade,
                    'uf' => self::$uf,
                    'cep' => self::$cepOrigem,
                    'ddd' => self::$ddd,
                    'telefone' => self::$telefone,
                    'email' => self::$email
                ]
            ];
            $this->webService = 'https://apphom.correios.com.br/logisticaReversaWS/logisticaReversaService/logisticaReversaWS?wsdl';
        }

        $this->function = $function;

        return $this->getWebservice();
    }

    public static function setConfig($value)
    {
        self::$codAdministrativo = isset($value['codAdministrativo']) ? $value['codAdministrativo'] : null;
        self::$codigo_servico = isset($value['codigo_servico']) ? $value['codigo_servico'] : null;
        self::$cartao = isset($value['cartao']) ? $value['cartao'] : null;
        self::$usuario = isset($value['usuario']) ? $value['usuario'] : null;
        self::$senha = isset($value['senha']) ? $value['senha'] : null;

        self::$nome = isset($value['nome']) ? $value['nome'] : null;
        self::$logradouro = isset($value['logradouro']) ? $value['logradouro'] : null;
        self::$numero = isset($value['numero']) ? $value['numero'] : null;
        self::$complemento = isset($value['complemento']) ? $value['complemento'] : null;
        self::$bairro = isset($value['bairro']) ? $value['bairro'] : null;
        self::$referencia = isset($value['referencia']) ? $value['referencia'] : null;
        self::$cidade = isset($value['cidade']) ? $value['cidade'] : null;
        self::$uf = isset($value['uf']) ? $value['uf'] : null;
        self::$cepOrigem = isset($value['cep']) ? $value['cep'] : null;
        self::$ddd = isset($value['ddd']) ? $value['ddd'] : null;
        self::$telefone = isset($value['telefone']) ? $value['telefone'] : null;
        self::$email = isset($value['email']) ? $value['email'] : null;
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