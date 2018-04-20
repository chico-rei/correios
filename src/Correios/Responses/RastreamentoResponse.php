<?php namespace ChicoRei\Packages\Correios\Responses;

/**
 * Class RastreamentoResponse
 * @package ChicoRei\Packages\Correios\Responses
 */
class RastreamentoResponse extends AbstractResponse
{
    /** @var mixed Resultado da requisição. */
    public $result;

    /**
     * @param $response
     */
    public function parse($response)
    {
        if ($response && isset($response->return->objeto) && !isset($response->return->objeto->erro) && isset($response->return->qtd) && $response->return->qtd > 1) {
            foreach ($response->return->objeto as $objeto) {
                if (isset($objeto->numero) && !isset($objeto->erro)) {
                    $result = new ObjetoResponse($objeto);
                    $this->result[] = $result;
                }
            }
        } elseif ($response && isset($response->return->objeto) && !isset($response->return->objeto->erro) && $response->return->qtd > 0) {
            if (isset($response->return->objeto->numero)) {
                $result = new ObjetoResponse($response->return->objeto);
                $this->result[] = $result;
            }
        } else {
            return;
        }
    }
}
