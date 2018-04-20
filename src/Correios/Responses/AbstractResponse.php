<?php namespace ChicoRei\Packages\Correios\Responses;

/**
 * Class AbstractResponse
 * @package ChicoRei\Packages\Correios\Responses
 */
abstract class AbstractResponse
{
    //<editor-fold desc="Fields">
    /** @var int Código de retorno. */
    protected $code;

    /** @var mixed Resultado da requisição. */
    protected $result;

    /** @var string Mensagem de erro */
    protected $error;
    //</editor-fold>

    protected $response;

    /**
     * @param mixed $response Objeto retornado pela chamada do web service.
     */
    public function __construct($response)
    {
        $this->response = $response;
        $this->parse($response);
    }

    /**
     * @return mixed
     */
    public function getResponse()
    {
        return $this->response;
    }

    public abstract function parse($response);
}