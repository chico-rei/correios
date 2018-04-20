<?php namespace ChicoRei\Packages\Correios\Responses;

/**
 * Class CancelarPedidoResponse
 * @package ChicoRei\Packages\Correios\Responses
 */
class CancelarPedidoResponse extends AbstractResponse
{
    public $result;

    /**
     * @param $response
     */
    public function parse($response)
    {
        if (isset($response) && $response != null) {
            if (isset($response->cancelarPedido) && isset($response->cancelarPedido->objeto_postal->numero_pedido)) {
                $result = new ObjetoPostalResponse();

                $result->numero_pedido = $response->cancelarPedido->objeto_postal->numero_pedido ?: null;
                $result->status_pedido = $response->cancelarPedido->objeto_postal->status_pedido ?: null;
                $result->datahora_cancelamento = $response->cancelarPedido->objeto_postal->datahora_cancelamento ?: null;

                $this->result = $result;
            }
        }
    }
}