<?php namespace WendelMoreira\Correios\Responses;

/**
 * Created by PhpStorm.
 * User: Wendel
 * Date: 19/06/2015
 * Time: 19:10
 */


class SolicitarPostagemReversaResponse extends AbstractResponse
{

    public $result;

    public function parse($response)
    {
        if(isset($response) && $response != null && count($response) > 0)
        {
            if(isset($response->solicitarPostagemReversa) && isset($response->solicitarPostagemReversa->resultado_solicitacao)){
                $result = new ResultadoSolicitacaoResponse();

                $result->tipo = $response->solicitarPostagemReversa->resultado_solicitacao->tipo ?:null ;
                $result->id_cliente = $response->solicitarPostagemReversa->resultado_solicitacao->id_cliente ?:null ;
                $result->numero_coleta = $response->solicitarPostagemReversa->resultado_solicitacao->numero_coleta ?:null ;
                $result->id_obj = $response->solicitarPostagemReversa->resultado_solicitacao->id_obj ?:null ;
                $result->status_objeto = $response->solicitarPostagemReversa->resultado_solicitacao->status_objeto ?:null ;
                $result->prazo = $response->solicitarPostagemReversa->resultado_solicitacao->prazo ?:null ;
                $result->data_solicitacao = $response->solicitarPostagemReversa->resultado_solicitacao->data_solicitacao ?:null ;
                $result->hora_solicitacao = $response->solicitarPostagemReversa->resultado_solicitacao->hora_solicitacao ?:null ;
                $result->codigo_erro = $response->solicitarPostagemReversa->resultado_solicitacao->codigo_erro ?:null ;

                $this->result = $result;
            }
        }
    }
}