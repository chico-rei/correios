<?php namespace ChicoRei\Packages\Correios\Responses;

/**
 * Created by PhpStorm.
 * User: Wendel
 * Date: 13/06/2016
 * Time: 22:10
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
    public function getResponse(){
        return $this->response;
    }

    public abstract function parse($response);
}