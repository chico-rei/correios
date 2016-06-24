<?php namespace ChicoRei\Packages\Correios;

abstract class CorreiosConfiguration
{
    /**
     * Configurações gerais dos webservices dos Correios
     */
    protected static $codAdministrativo;
    protected static $usuario;
    protected static $usuario_reversa;
    protected static $senha;
    protected static $senha_reversa;
    protected static $contrato;
    protected static $cepOrigem;
    protected static $codigo_servico;
    protected static $cartao;

    protected static $nome;
    protected static $logradouro;
    protected static $numero;
    protected static $complemento;
    protected static $bairro;
    protected static $referencia;
    protected static $cidade;
    protected static $uf;
    protected static $ddd;
    protected static $telefone;
    protected static $email;

    protected static $environment;
}