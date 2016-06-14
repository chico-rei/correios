<?php namespace WendelMoreira\Correios\Responses;

/**
 * Created by PhpStorm.
 * User: WendelMoreira
 * Date: 13/06/2016
 * Time: 22:10
 */
class ConsultaCEPResponse extends AbstractResponse
{
    public $result;

    public function parse($response)
    {
        if(isset($response) && $response != null && count($response) > 0)
        {
            if(isset($response->return)){
                $result = new EnderecoResponse();
                $result->cidade = $response->return->cidade ? $response->return->cidade : null;
                $result->endereco = $response->return->end ? $response->return->end : null;
                $result->uf = $response->return->uf ? $response->return->uf : null;
                $result->bairro = $response->return->bairro ? $response->return->bairro : null;
                $this->result = $result;
            }
        }
    }
}
