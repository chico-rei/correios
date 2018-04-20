<?php namespace ChicoRei\Packages\Correios;

use Exception;
use SoapClient;

/**
 * Class CorreiosService
 * @package ChicoRei\Packages\Correios
 */
class CorreiosService extends CorreiosConfiguration
{
    private $function;
    private $webService;
    private $commonParameters;
    private $parameters;
    private $paramsWs;

    /** Webservices de produção **/
    const WEBSERVICE_CLIENTE = 'https://apps.correios.com.br/SigepMasterJPA/AtendeClienteService/AtendeCliente?wsdl';
    const WEBSERVICE_CALCULADOR =  'http://ws.correios.com.br/calculador/CalcPrecoPrazo.asmx?WSDL';
    const WEBSERVICE_REVERSA = 'https://cws.correios.com.br/logisticaReversaWS/logisticaReversaService/logisticaReversaWS?wsdl';
    const WEBSERVICE_RASTRO = 'http://webservice.correios.com.br/service/rastro/Rastro.wsdl';

    /** Webservices de desenvolvimento */
    const WEBSERVICE_CLIENTE_DEV = 'https://apphom.correios.com.br/SigepMasterJPA/AtendeClienteService/AtendeCliente?wsdl';
    const WEBSERVICE_CALCULADOR_DEV =  'http://ws.correios.com.br/calculador/CalcPrecoPrazo.asmx?WSDL';
    const WEBSERVICE_REVERSA_DEV = 'https://apphom.correios.com.br/logisticaReversaWS/logisticaReversaService/logisticaReversaWS?wsdl';
    const WEBSERVICE_RASTRO_DEV = 'http://webservice.correios.com.br/service/rastro/Rastro.wsdl';

    private $functionsWeb1 = [
        'atualizaPLP',
        'bloquearObjeto',
        'buscaCliente',
        'buscaContrato',
        'buscaServicos',
        'cancelarPedidoScol',
        'consultaCEP',
        'consultaSRO',
        'consultarPedidosInformacao',
        'fechaPlp',
        'fechaPlpVariosServicos',
        'geraDigitoVerificadorEtiquetas',
        'getStatusCartaoPostagem',
        'integrarUsuarioScol',
        'obterAssuntosPI',
        'obterClienteAtualizacao',
        'obterEmbalagemLRS',
        'obterMensagemRetornoPI',
        'obterMotivosPI',
        'registrarPedidosInformacao',
        'solicitaEtiquetas',
        'solicitaPLP',
        'solicitaXmlPlp',
        'solicitarPostagemScol',
        'validaEtiquetaPLP',
        'validaPlp',
        'validarPostagemReversa',
        'validarPostagemSimultanea',
        'verificaDisponibilidadeServico',
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
        'solicitarPostagemReversa',
        'cancelarPedido',
        'acompanharPedido',
    ];

    private $functionsWeb4 = [
        'RastroJson',
        'buscaEventosLista',
        'buscaEventos',
    ];

    private $functionsWeb5 = [
        'CalcPrecoPrazoInter',
    ];

    public function  __call($function, $parameters)
    {
        $this->function = $function;
        $this->parameters = $parameters;
        $this->commonParameters = [
            'codAdministrativo' => self::$codAdministrativo,
            'usuario' => self::$usuario,
            'senha' => self::$senha,
        ];

        if (in_array($function, $this->functionsWeb1))
        {
            $this->webService = self::$environment == 'DEV' ? static::WEBSERVICE_CLIENTE_DEV : static::WEBSERVICE_CLIENTE;
        }
        elseif (in_array($function, $this->functionsWeb2))
        {
            $this->webService = self::$environment == 'DEV' ? static::WEBSERVICE_CALCULADOR_DEV : static::WEBSERVICE_CALCULADOR;
            $this->commonParameters = [
                'nCdEmpresa' => self::$codAdministrativo,
                'sDsSenha' => self::$senha,
                'sCepOrigem' => self::$cepOrigem,
            ];
        }
        elseif (in_array($function, $this->functionsWeb3))
        {
            $this->webService = self::$environment == 'DEV' ? static::WEBSERVICE_REVERSA_DEV : static::WEBSERVICE_REVERSA;
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
        }
        elseif (in_array($function, $this->functionsWeb4))
        {
            $this->webService = self::$environment == 'DEV' ? static::WEBSERVICE_RASTRO_DEV : static::WEBSERVICE_RASTRO;
            $this->commonParameters = [
                'usuario' => self::$usuario,
                'senha' => self::$senha,
            ];
        }
        elseif (in_array($function, $this->functionsWeb5))
        {
            return $this->getWebserviceInter();
        }

        return $this->getWebservice();
    }

    /**
     * Seta as configurações para acesso aos webservices
     * @param $value
     * @return bool
     */
    public static function setConfig($value)
    {
        self::$codAdministrativo = isset($value['codAdministrativo']) ? $value['codAdministrativo'] : null;
        self::$codigo_servico = isset($value['codigo_servico']) ? $value['codigo_servico'] : null;
        self::$cartao = isset($value['cartao']) ? $value['cartao'] : null;
        self::$contrato = isset($value['contrato']) ? $value['contrato'] : null;
        self::$usuario = isset($value['usuario']) ? $value['usuario'] : null;
        self::$usuario_reversa = isset($value['usuario_reversa']) ? $value['usuario_reversa'] : null;
        self::$senha = isset($value['senha']) ? $value['senha'] : null;
        self::$senha_reversa = isset($value['senha_reversa']) ? $value['senha_reversa'] : null;

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
        self::$environment = isset($value['environment']) ? $value['environment'] : 'DEV';

        return true;
    }

    /**
     * Realiza a chamada no webservice
     * @return Exception
     */
    public function getWebservice()
    {
        $this->paramsWs = array_merge($this->commonParameters, $this->parameters);

        try
        {
            $data = [
                'trace' => true,
                'exceptions' => true,
                'compression' => SOAP_COMPRESSION_ACCEPT | SOAP_COMPRESSION_GZIP,
                'connection_timeout' => 10,
            ];

            if (in_array($this->webService, [static::WEBSERVICE_REVERSA, static::WEBSERVICE_REVERSA_DEV]))
                $data = array_merge([
                    'login' => self::$usuario_reversa,
                    'password' => self::$senha_reversa,
                    'connection_timeout' => 100,
                ], $data);
            else
                $data = array_merge([
                    'connection_timeout' => 10,
                ], $data);

            if (self::$environment == 'DEV')
            {
                $data = array_merge($data, [
                    'verifypeer'            => false,
                    'verifyhost'            => false,
                    'soap_version'          => SOAP_1_1
                ]);
            }

            $clientWS = new SoapClient($this->webService, $data);

            $function = $this->function;
            $resultWS = $clientWS->$function($this->paramsWs);

            return $resultWS;
        }
        catch (Exception $e)
        {
            return $e;
        }
    }

    /**
     * Acesso ao webservice de cálculo de frete internacional
     *
     * @return int|\SimpleXMLElement
     */
    private function getWebserviceInter()
    {
        try
        {
            $curl = curl_init();
            $postData = ['ip' => '179.184.161.94'];
            curl_setopt($curl, CURLOPT_HEADER, 0);
            curl_setopt($curl, CURLOPT_VERBOSE, 0);
            curl_setopt($curl, CURLOPT_USERAGENT, "Mozilla/4.0 (compatible;)");
            curl_setopt($curl, CURLOPT_URL, $this->webService);
            curl_setopt($curl, CURLOPT_TIMEOUT, 10);
            curl_setopt($curl, CURLOPT_POST, true);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $postData);
            curl_setopt($curl, CURLOPT_CONNECTTIMEOUT_MS, 1500);
            curl_setopt($curl, CURLOPT_TIMEOUT_MS, 1500);

            $resp = curl_exec($curl);
            $response_code = curl_getinfo($curl, CURLINFO_HTTP_CODE);

            curl_close($curl);

            if ($response_code != 200)
                return 0;
            else
                return simplexml_load_string($resp);
        }
        catch (Exception $e)
        {
            return 0;
        }
    }
}
