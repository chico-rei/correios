<?php namespace ChicoRei\Packages\Correios;

use ChicoRei\Packages\Correios\Responses\ConsultaCEPResponse;

class ConsultaEnderecoClient extends CorreiosService
{
    public function consultaCEP($cep)
    {
        // Seta default_socket_timeout para que a consulta seja feita offline quando houver falha
        // de comunicação com o sistema dos Correios.
        ini_set('default_socket_timeout', 10);

        $response = $this->__call('consultaCEP',
            ['cep' => $cep]
        );

        return new ConsultaCEPResponse($response);
    }
}
