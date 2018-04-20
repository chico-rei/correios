<?php namespace ChicoRei\Packages\Correios;

use ChicoRei\Packages\Correios\Responses\AcompanharPedidoResponse;
use ChicoRei\Packages\Correios\Responses\CancelarPedidoResponse;
use ChicoRei\Packages\Correios\Responses\SolicitarPostagemReversaResponse;

/**
 * Class PostagemReversaClient
 * @package ChicoRei\Packages\Correios
 */
class PostagemReversaClient extends CorreiosService
{
    /**
     * Solicita código de postagem reversa
     *
     * @param $data
     * @return SolicitarPostagemReversaResponse
     */
    public function solicitarPostagemReversa($data)
    {
        $coleta = [
            'tipo' => isset($data['tipo']) ? $data['tipo'] : null,
            'numero' => isset($data['numero']) ? $data['numero'] : null,
            'id_cliente' => isset($data['id_cliente']) ? $data['id_cliente'] : null,
            'ag' => isset($data['ag']) ? $data['ag'] : null,
            'cartao' => self::$cartao,
            'valor_declarado' => isset($data['valor_declarado']) ? $data['valor_declarado'] : null,
            'servico_adicional' => isset($data['servico_adicional']) ? $data['servico_adicional'] : null,
            'descricao' => isset($data['descricao']) ? $data['descricao'] : null,
            'ar' => isset($data['ar']) ? $data['ar'] : null,
            'cklist' => isset($data['cklist']) ? $data['cklist'] : null,
            'documento' => isset($data['documento']) ? $data['documento'] : null,
            'remetente' => [
                'nome' => isset($data['remetente']['nome']) ? $data['remetente']['nome'] : null,
                'logradouro' => isset($data['remetente']['logradouro']) ? $data['remetente']['logradouro'] : null,
                'numero' => isset($data['remetente']['numero']) ? $data['remetente']['numero'] : null,
                'complemento' => isset($data['remetente']['complemento']) ? $data['remetente']['complemento'] : null,
                'bairro' => isset($data['remetente']['bairro']) ? $data['remetente']['bairro'] : null,
                'cidade' => isset($data['remetente']['cidade']) ? $data['remetente']['cidade'] : null,
                'uf' => isset($data['remetente']['uf']) ? $data['remetente']['uf'] : null,
                'cep' => isset($data['remetente']['cep']) ? $data['remetente']['cep'] : null,
                'referencia' => isset($data['remetente']['referencia']) ? $data['remetente']['referencia'] : null,
                'ddd' => isset($data['remetente']['ddd']) ? $data['remetente']['ddd'] : null,
                'telefone' => isset($data['remetente']['telefone']) ? $data['remetente']['telefone'] : null,
                'email' => isset($data['remetente']['email']) ? $data['remetente']['email'] : null,
                'identificacao' => isset($data['remetente']['identificacao']) ? $data['remetente']['identificacao'] : null
            ],
            'obj_col' => [
                'item' => isset($data['obj']['item']) ? $data['obj']['item'] : null,
                'desc' => isset($data['obj']['desc']) ? $data['obj']['desc'] : null,
                'entrega' => isset($data['obj']['entrega']) ? $data['obj']['entrega'] : null,
                'num' => isset($data['obj']['num']) ? $data['obj']['num'] : null,
                'id' => isset($data['obj']['id']) ? $data['obj']['id'] : null
            ]
        ];

        if (isset($data['produto'])) {
            $coleta = array_merge($coleta, ['produto' => $data['produto']]);
        }

        $response = $this->__call('solicitarPostagemReversa', [
            'coletas_solicitadas' => $coleta,
            'codigo_servico' => $data['codigo_servico']
        ]);

        return new SolicitarPostagemReversaResponse($response);
    }

    /**
     * Cancela pedido de logística reversa
     *
     * @param $data
     * @return CancelarPedidoResponse
     */
    public function cancelarPedido($data)
    {
        $response = $this->__call('cancelarPedido', [
            'numeroPedido' => isset($data['numero_pedido']) ? $data['numero_pedido'] : null,
            'tipo' => isset($data['tipo']) ? $data['tipo'] : null
        ]);

        return new CancelarPedidoResponse($response);
    }

    /**
     * Acompanha histórico de pedido de logística reversa
     *
     * @param $data
     * @return AcompanharPedidoResponse
     */
    public function acompanharPedido($data)
    {
        $response = $this->__call('acompanharPedido', [
            'tipoBusca' => isset($data['tipo_busca']) ? $data['tipo_busca'] : null,
            'tipoSolicitacao' => isset($data['tipo_solicitacao']) ? $data['tipo_solicitacao'] : null,
            'numeroPedido' => isset($data['numero_pedido']) ? intval($data['numero_pedido']) : null
        ]);

        return new AcompanharPedidoResponse($response);
    }
}