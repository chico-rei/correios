<?php namespace ChicoRei\Packages\Correios\Responses;

/**
 * Class ResultadoSolicitacaoResponse
 * @package ChicoRei\Packages\Correios\Responses
 */
class ResultadoSolicitacaoResponse
{
    public $tipo;
    public $id_cliente;
    public $numero_coleta;
    public $id_obj;
    public $status_objeto;
    public $prazo;
    public $data_solicitacao;
    public $hora_solicitacao;
    public $codigo_erro;
    public $descricao_erro;
}