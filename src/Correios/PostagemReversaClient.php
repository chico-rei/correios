<?php namespace WendelMoreira\Correios;

use WendelMoreira\Correios\Responses\AcompanharPedidoResponse;
use WendelMoreira\Correios\Responses\CancelarPedidoResponse;
use WendelMoreira\Correios\Responses\SolicitarPostagemReversaResponse;

class PostagemReversaClient extends CorreiosService
{
    /**
     * Solicita postagem de logística reversa
     * @param $data
     * @return SolicitarPostagemReversaResponse
     */
    public function solicitarPostagemReversa($data)
    {
        $coleta = [
            'tipo' => $data['tipo'],
            'numero' => $data['numero'],
            'id_cliente' => $data['id_cliente'],
            'ag' => $data['ag'],
            'cartao' => self::$cartao,
            'valor_declarado' => $data['valor_declarado'],
            'servico_adicional' => $data['servico_adicional'],
            'descricao' => $data['descricao'],
            'ar' => $data['ar'],
            'cklist' => $data['cklist'],
            'documento' => $data['documento'],
            'remetente' => [
                'nome' => $data['remetente']['nome'],
                'logradouro' => $data['remetente']['logradouro'],
                'numero' => $data['remetente']['numero'],
                'complemento' => $data['remetente']['complemento'],
                'bairro' => $data['remetente']['bairro'],
                'cidade' => $data['remetente']['cidade'],
                'uf' => $data['remetente']['uf'],
                'cep' => $data['remetente']['cep'],
                'referencia' => $data['remetente']['referencia'],
                'ddd' => $data['remetente']['ddd'],
                'telefone' => $data['remetente']['telefone'],
                'email' => $data['remetente']['email'],
                'identificacao' => $data['remetente']['identificacao']
            ],
            'obj_col' => [
                'item' => $data['obj']['item'],
                'desc' => $data['obj']['desc'],
                'entrega' => $data['obj']['entrega'],
                'num' => $data['obj']['num'],
                'id' => $data['obj']['id']
            ]
        ];

        if(isset($data['produto']))
            $coleta = array_merge($coleta, ['produto' => $data['produto']]);

        $response = $this->__call('solicitarPostagemReversa',
            ['coletas_solicitadas' => $coleta]
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