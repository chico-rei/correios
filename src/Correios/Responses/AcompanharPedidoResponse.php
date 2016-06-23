<?php namespace WendelMoreira\Correios\Responses;

/**
 * Created by PhpStorm.
 * User: Wendel
 * Date: 20/06/2015
 * Time: 23:10
 */


class AcompanharPedidoResponse extends AbstractResponse
{

    public $result;

    public function parse($response)
    {
        if(isset($response) && $response != null && count($response) > 0)
        {
            if(isset($response->acompanharPedido) && isset($response->acompanharPedido->numero_pedido)){
                $result = new ColetaResponse();

                $result->numero_pedido = $response->acompanharPedido->numero_pedido ?:null ;
                $result->controle_cliente = $response->acompanharPedido->controle_cliente ?:null ;

                //TODO: tratar histórico
                $this->result = $result;
            }
        }
    }
}