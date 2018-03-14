<?php namespace ChicoRei\Packages\Correios\Responses;

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
        if(isset($response) && $response != null)
        {
            if(isset($response->acompanharPedido) && isset($response->acompanharPedido->coleta->numero_pedido)){
                $result = new ColetaResponse();

                $result->numero_pedido = $response->acompanharPedido->coleta->numero_pedido ?:null ;
                $result->controle_cliente = $response->acompanharPedido->coleta->controle_cliente ?:null ;

                if ($response->acompanharPedido->coleta->historico && is_array($response->acompanharPedido->coleta->historico))
                    $historico = $response->acompanharPedido->coleta->historico;
                else
                    $historico[] = $response->acompanharPedido->coleta->historico;

                foreach ($historico as $status)
                    $result->historico = [
                        'status' => $status->status,
                        'descricao_status' => $status->descricao_status,
                        'data_atualizacao' => $status->data_atualizacao,
                        'hora_atualizacao' => $status->hora_atualizacao,
                        'observacao' => $status->hora_atualizacao,
                    ];

                $result->objeto = [
                    'numero_etiqueta' => $response->acompanharPedido->coleta->objeto->numero_etiqueta,
                    'controle_objeto_cliente' => $response->acompanharPedido->coleta->objeto->controle_objeto_cliente,
                    'ultimo_status' => $response->acompanharPedido->coleta->objeto->ultimo_status,
                    'descricao_status' => $response->acompanharPedido->coleta->objeto->descricao_status,
                    'data_ultima_atualizacao' => $response->acompanharPedido->coleta->objeto->data_ultima_atualizacao,
                    'hora_ultima_atualizacao' => $response->acompanharPedido->coleta->objeto->hora_ultima_atualizacao,
                    'valor_postagem' => isset($response->acompanharPedido->coleta->objeto->valor_postagem) ? $response->acompanharPedido->coleta->objeto->valor_postagem : null,
                ];

                $this->result = $result;
            }
        }
    }
}