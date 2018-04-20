<?php namespace ChicoRei\Packages\Correios\Responses;

/**
 * Class CalcPrecoPrazoResponse
 * @package ChicoRei\Packages\Correios\Responses
 */
class CalcPrecoPrazoResponse extends AbstractResponse
{
    /** @var mixed Resultado da requisição. */
    public $result;

    /**
     * @param $response
     */
    public function parse($response)
    {
        if ($response && isset($response->CalcPrecoPrazoResult)) {
            $this->result = $response->CalcPrecoPrazoResult->Servicos->cServico;
        } elseif (isset($response->faultstring)) {
            $this->error = $response->faultstring;
        }
    }
}
