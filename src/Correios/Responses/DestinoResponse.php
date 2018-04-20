<?php namespace ChicoRei\Packages\Correios\Responses;

/**
 * Class DestinoResponse
 * @package ChicoRei\Packages\Correios\Responses
 */
class DestinoResponse extends AbstractResponse
{
    public $local;
    public $codigo;
    public $cidade;
    public $bairro;
    public $uf;

    /**
     * @param $response
     */
    public function parse($response)
    {
        $this->local = isset($response->local) ? $response->local : '';
        $this->codigo = isset($response->codigo) ? $response->codigo : '';
        $this->cidade = isset($response->cidade) ? $response->cidade : '';
        $this->bairro = isset($response->bairro) ? $response->bairro : '';
        $this->uf = isset($response->uf) ? $response->uf : '';
    }
}
