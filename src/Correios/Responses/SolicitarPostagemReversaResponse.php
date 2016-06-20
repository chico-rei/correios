<?php namespace WendelMoreira\Correios\Responses;

/**
 * Created by PhpStorm.
 * User: Wendel
 * Date: 19/06/2015
 * Time: 19:10
 */


class SolicitarPostagemReversaResponse
{

    public $result;

    public function parse($response)
    {
        if(isset($response) && $response != null && count($response) > 0)
        {
            if(isset($response->solicitarPostagemReversa) && isset($response->solicitarPostagemReversa->resultado_solicitacao)){
                $result = new ResultadoSolicitacaoResponse();
                $result->numero_coleta = $response->solicitarPostagemReversa->resultado_solicitacao->numero_coleta ?:null ;

                $this->result = $result;
            }
        }
    }
}