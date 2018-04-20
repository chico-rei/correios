<?php namespace ChicoRei\Packages\Correios\Responses;

/**
 * Class CalcPrecoPrazoInterResponse
 * @package ChicoRei\Packages\Correios\Responses
 */
class CalcPrecoPrazoInterResponse extends AbstractResponse
{
    /** @var mixed Resultado da requisição. */
    public $result;

    /**
     * @param $response
     */
    public function parse($response)
    {
        $this->result = $response;
    }
}
