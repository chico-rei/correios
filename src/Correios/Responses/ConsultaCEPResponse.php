<?php namespace ChicoRei\Packages\Correios\Responses;

/**
 * Class ConsultaCEPResponse
 * @package ChicoRei\Packages\Correios\Responses
 */
class ConsultaCEPResponse extends AbstractResponse
{
    public $result;

    /**
     * @param $response
     */
    public function parse($response)
    {
        if (isset($response) && $response != null && count((array)$response) > 0) {
            if (isset($response->return)) {
                $result = new EnderecoResponse();
                $result->cidade = $response->return->cidade ? $response->return->cidade : null;
                $result->endereco = $response->return->end ? $response->return->end : null;
                $result->uf = $response->return->uf ? $response->return->uf : null;
                $result->bairro = $response->return->bairro ? $response->return->bairro : null;
                $this->result = $result;
            }
        }
    }
}
