<?php namespace ChicoRei\Packages\Correios\Responses;

/**
 * Created by PhpStorm.
 * User: Wendel
 * Date: 20/06/2015
 * Time: 23:10
 */


class CancelarPedidoResponse extends AbstractResponse
{

    public $result;

    public function parse($response)
    {
        if(isset($response) && $response != null && count($response) > 0)
        {
            if(isset($response->cancelarPedido) && isset($response->cancelarPedido->objeto_postal->numero_pedido)){
                $result = new ObjetoPostalResponse();

                $result->numero_pedido = $response->cancelarPedido->objeto_postal->numero_pedido ?:null ;
                $result->status_pedido = $response->cancelarPedido->objeto_postal->status_pedido ?:null ;
                $result->datahora_cancelamento = $response->cancelarPedido->objeto_postal->datahora_cancelamento ?:null ;

                $this->result = $result;
            }
        }
    }
}