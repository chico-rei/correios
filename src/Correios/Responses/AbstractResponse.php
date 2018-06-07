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

    /** @var mixed Resposta original */
    protected $response;
    //</editor-fold>

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

    /**
     * @return mixed
     */
    public function getResult()
    {
        return $this->result;
    }

    /**
     * @return mixed
     */
    public function getError()
    {
        return $this->error;
    }

    public abstract function parse($response);
}
