<?php namespace WendelMoreira\Correios\Responses;

/**
 * Created by PhpStorm.
 * User: Wendel
 * Date: 20/06/2015
 * Time: 23:10
 */


class CancelarPedidoResponse
{

    public $result;

    public function parse($response)
    {
        if(isset($response) && $response != null && count($response) > 0)
        {
            if(isset($response->cancelarPedido) && isset($response->cancelarPedido->objeto_postal)){
                $result = new ObjetoPostalResponse();

                $result->numero_pedido = $response->cancelarPedido->numero_pedido ?:null ;
                $result->status_pedido = $response->cancelarPedido->status_pedido ?:null ;
                $result->datahora_cancelamento = $response->cancelarPedido->datahora_cancelamento ?:null ;

                $this->result = $result;
            }
        }
    }
}