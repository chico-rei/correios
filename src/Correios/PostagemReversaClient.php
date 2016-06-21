<?php namespace WendelMoreira\Correios;


use WendelMoreira\Correios\Responses\SolicitarPostagemReversaResponse;

class SolicitarPostagemReversaClient extends CorreiosService
{
    public function solicitarPostagemReversa($data)
    {
        $response = $this->__call('solicitarPostagemReversa',
            array(
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
            )
        );

        return new SolicitarPostagemReversaResponse($response);
    }

    public function cancelarPedido()
    {

    }

    public function acompanharPedido()
    {

    }

    public function acompanharPedidoPorData()
    {

    }
}