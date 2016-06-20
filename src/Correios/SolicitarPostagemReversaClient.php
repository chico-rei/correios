<?php namespace WendelMoreira\Correios;


use WendelMoreira\Correios\Responses\SolicitarPostagemReversaResponse;

class PostagemReversaClient extends CorreiosService
{
    public function solicitarPostagemReversa($codServico)
    {
        $response = $this->__call('solicitarPostagemReversa',
            array(
                'codigo_servico' => $codServico
            )
        );

        return new SolicitarPostagemReversaResponse($response);
    }
}