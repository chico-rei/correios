<?php namespace ChicoRei\Packages\Correios;

use ChicoRei\Packages\Correios\Responses\RastreamentoResponse;

/**
 * Class RastreamentoClient
 * @package ChicoRei\Packages\Correios
 */
class RastreamentoClient extends CorreiosService
{
    /**
     * @param $objeto
     * @param $lingua
     * @return RastreamentoResponse
     */
    public function RastreamentoObjeto($objeto, $lingua)
    {
        $linguagem = $lingua == 1 ? 101 : 102;

        $response = $this->__call('buscaEventosLista', [
            'tipo' => 'L',
            'resultado' => 'T',
            'lingua' => $linguagem,
            'objetos' => $objeto,
        ]);

        return new RastreamentoResponse($response);
    }
}
