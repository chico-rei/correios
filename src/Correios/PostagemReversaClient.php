<?php namespace WendelMoreira\Correios;

use WendelMoreira\Correios\Responses\AcompanharPedidoResponse;
use WendelMoreira\Correios\Responses\CancelarPedidoResponse;
use WendelMoreira\Correios\Responses\SolicitarPostagemReversaResponse;

class SolicitarPostagemReversaClient extends CorreiosService
{
    /**
     * Solicita postagem de logística reversa
     * @param $data
     * @return SolicitarPostagemReversaResponse
     */
    public function solicitarPostagemReversa($data)
    {
        $response = $this->__call('solicitarPostagemReversa',
            [
                'tipo' => $data['tipo'],
                'numero' => $data['numero'],
                'id_cliente' => $data['id_cliente'],
                'ag' => $data['ag'],
                'cartao' => self::$cartao,
                'valor_declarado' => $data['valor_declarado'],
                'servico_adicional' => $data['servico_adicional'],
                'descricao' => $data['descricao'],
                'ar' => $data['ar'],
                'cklist' => [
                    'documento' => $data['documento']
                ],
                'remetente' => [
                    'nome' => $data['nome'],
                    'logradouro' => $data['logradouro'],
                    'numero' => $data['numero'],
                    'complemento' => $data['complemento'],
                    'bairro' => $data['bairro'],
                    'cidade' => $data['cidade'],
                    'uf' => $data['uf'],
                    'cep' => $data['cep'],
                    'referencia' => $data['referencia'],
                    'ddd' => $data['ddd'],
                    'telefone' => $data['telefone'],
                    'email' => $data['email']
                ],
            ]
        );

        return new SolicitarPostagemReversaResponse($response);
    }

    /**
     * Cancela pedido de logística reversa
     * @param $data
     * @return CancelarPedidoResponse
     */
    public function cancelarPedido($data)
    {
        $response = $this->__call('cancelarPedido',
            [
                'numeroPedido' => $data['numero_pedido'],
                'tipo' => $data['tipo']
            ]
        );

        return new CancelarPedidoResponse($response);
    }

    /**
     * Acompanha histórico de pedido de logística reversa
     * @param $data
     * @return AcompanharPedidoResponse
     */
    public function acompanharPedido($data)
    {
        $response = $this->__call('acompanharPedido',
            [
                'tipoBusca' => $data['tipo_busca'],
                'tipoSolicitacao' => $data['tipo_solicitacao'],
                'numeroPedido' => $data['numero_pedido']
            ]
        );

        return new AcompanharPedidoResponse($response);

    }

}