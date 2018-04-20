<?php namespace ChicoRei\Packages\Correios\Responses;

/**
 * Class ObjetoResponse
 * @package ChicoRei\Packages\Correios\Responses
 */
class ObjetoResponse extends AbstractResponse
{
    public $numero;
    public $sigla;
    public $categoria;
    public $evento;

    /**
     * @param $response
     */
    public function parse($response)
    {
        $this->numero = $response->numero ? $response->numero : '';
        $this->categoria = $response->categoria ? $response->categoria : '';
        $this->sigla = $response->sigla ? $response->sigla : '';
        $this->evento = $this::setEventos($response->evento);
    }

    /**
     * Seta os eventos de um objeto
     *
     * @param $eventos
     * @return array
     */
    private static function setEventos($eventos)
    {
        $return = [];

        foreach ($eventos as $evento) {
            $return[] = isset($evento) ? new EventoResponse($evento) : null;
        }

        return $return;
    }
}