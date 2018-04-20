<?php namespace ChicoRei\Packages\Correios\Responses;

/**
 * Class SolicitarPostagemReversaResponse
 * @package ChicoRei\Packages\Correios\Responses
 */
class SolicitarPostagemReversaResponse extends AbstractResponse
{
    public $result;

    /**
     * @param $response
     */
    public function parse($response)
    {
        if (!isset($response) && $response != null) return;

        if (isset($response->solicitarPostagemReversa) && isset($response->solicitarPostagemReversa->resultado_solicitacao)) {
            $result = new ResultadoSolicitacaoResponse();

            $result->tipo = isset($response->solicitarPostagemReversa->resultado_solicitacao->tipo) ? $response->solicitarPostagemReversa->resultado_solicitacao->tipo : null;
            $result->id_cliente = isset($response->solicitarPostagemReversa->resultado_solicitacao->id_cliente) ? $response->solicitarPostagemReversa->resultado_solicitacao->id_cliente : null;
            $result->numero_coleta = isset($response->solicitarPostagemReversa->resultado_solicitacao->numero_coleta) ? $response->solicitarPostagemReversa->resultado_solicitacao->numero_coleta : null;
            $result->id_obj = isset($response->solicitarPostagemReversa->resultado_solicitacao->id_obj) ? $response->solicitarPostagemReversa->resultado_solicitacao->id_obj : null;
            $result->status_objeto = isset($response->solicitarPostagemReversa->resultado_solicitacao->status_objeto) ? $response->solicitarPostagemReversa->resultado_solicitacao->status_objeto : null;
            $result->prazo = isset($response->solicitarPostagemReversa->resultado_solicitacao->prazo) ? $response->solicitarPostagemReversa->resultado_solicitacao->prazo : null;
            $result->data_solicitacao = isset($response->solicitarPostagemReversa->resultado_solicitacao->data_solicitacao) ? $response->solicitarPostagemReversa->resultado_solicitacao->data_solicitacao : null;
            $result->hora_solicitacao = isset($response->solicitarPostagemReversa->resultado_solicitacao->hora_solicitacao) ? $response->solicitarPostagemReversa->resultado_solicitacao->hora_solicitacao : null;
            $result->codigo_erro = isset($response->solicitarPostagemReversa->resultado_solicitacao->codigo_erro) ? $response->solicitarPostagemReversa->resultado_solicitacao->codigo_erro : null;
            $result->descricao_erro = isset($response->solicitarPostagemReversa->resultado_solicitacao->descricao_erro) ? $response->solicitarPostagemReversa->resultado_solicitacao->descricao_erro : null;

            $this->result = $result;
        }
    }
}