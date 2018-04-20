<?php namespace ChicoRei\Packages\Correios;

use ChicoRei\Packages\Correios\Responses\ConsultaCEPResponse;

/**
 * Class ConsultaEnderecoClient
 * @package ChicoRei\Packages\Correios
 */
class ConsultaEnderecoClient extends CorreiosService
{
    /**
     * @param $cep
     * @return ConsultaCEPResponse
     */
    public function consultaCEP($cep)
    {
        ini_set('default_socket_timeout', 10);

        $response = $this->__call('consultaCEP', ['cep' => $cep]);

        return new ConsultaCEPResponse($response);
    }
}
