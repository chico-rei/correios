<?php namespace ChicoRei\Packages\Correios;

use ChicoRei\Packages\Correios\Responses\CalcPrecoPrazoInterResponse;
use ChicoRei\Packages\Correios\Responses\CalcPrecoPrazoResponse;

/**
 * Class CalculoFreteClient
 * @package ChicoRei\Packages\Correios
 */
class CalculoFreteClient extends CorreiosService
{
    /**
     * @param $cepDestino
     * @param $peso
     * @param $valorPedido
     * @param $formato
     * @param $altura
     * @param $largura
     * @param $comprimento
     * @param $diametro
     * @return CalcPrecoPrazoResponse
     */
    public function CalcPrecoPrazo($cepDestino, $peso, $valorPedido, $formato, $altura, $largura, $comprimento, $diametro)
    {
        if ($formato == 3 && $peso > 1.000) $formato = 1;

        $response = $this->__call('CalcPrecoPrazo', [
            'sCepDestino' => $cepDestino,
            'nCdFormato' => $formato,
            'nVlAltura' => $altura,
            'nVlLargura' => $largura,
            'nVlComprimento' => $comprimento,
            'nVlDiametro' => $diametro,
            'nVlPeso' => $peso,
            'nVlValorDeclarado' => $valorPedido
        ]);

        return new CalcPrecoPrazoResponse($response);
    }

    /**
     * @param $isoPais
     * @param $peso
     * @param $altura
     * @param $largura
     * @param $comprimento
     * @return CalcPrecoPrazoInterResponse
     */
    public function CalcPrecoPrazoInter($isoPais, $peso, $altura, $largura, $comprimento)
    {
        $peso = round($peso, 3);

        $response = $this->__call('CalcPrecoPrazoInter', [
            'isoPais' => $isoPais,
            'peso' => str_replace('.', '', $peso),
            'altura' => $altura,
            'largura' => $largura,
            'comprimento' => $comprimento
        ]);

        return new CalcPrecoPrazoInterResponse($response);
    }
} 
