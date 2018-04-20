<?php namespace ChicoRei\Packages\Correios\Responses;

use Carbon\Carbon;

/**
 * Class EventoResponse
 * @package ChicoRei\Packages\Correios\Responses
 */
class EventoResponse extends AbstractResponse
{
    public $tipo;
    public $status;
    public $data;
    public $descricao;
    public $local;
    public $codigo;
    public $cidade;
    public $uf;
    public $destino;

    /**
     * @param $response
     */
    public function parse($response)
    {
        if (!isset($response->tipo)) return;

        $this->tipo = $response->tipo;
        $this->status = $response->status;
        $this->data = Carbon::createFromFormat('d/m/Y H:i:s', $response->data . ' ' . $response->hora . ':00');
        $this->descricao = $response->descricao;
        $this->local = $response->local;
        $this->codigo = $response->codigo;
        $this->cidade = isset($response->cidade) ? $response->cidade : null;
        $this->uf = isset($response->uf) ? $response->uf : null;
        $this->destino = isset($response->destino) ? new DestinoResponse($response->destino) : null;
    }
}
