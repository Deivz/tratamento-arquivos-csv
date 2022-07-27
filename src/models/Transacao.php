<?php

namespace Deivz\TratamentoArquivosCsv\models;

class Transacao
{
    private string $bancoOrigem;
    private string $agenciaOrigem;
    private string $contaOrigem;
    private string $bancoDestino;
    private string $agenciaDestino;
    private string $contaDestino;
    private string $valor;
    private string $timeStamp;

    public function __construct(
        string $bancoOrigem,
        string $agenciaOrigem,
        string $contaOrigem,
        string $bancoDestino,
        string $agenciaDestino,
        string $contaDestino,
        string $valor,
        string $timeStamp
    )
    {
        $this->bancoOrigem = $bancoOrigem;
        $this->agenciaOrigem = $agenciaOrigem;
        $this->contaOrigem = $contaOrigem;
        $this->bancoDestino = $bancoDestino;
        $this->agenciaDestino = $agenciaDestino;
        $this->contaDestino = $contaDestino;
        $this->valor = $valor;
        $this->timeStamp = $timeStamp;
    }

    public function __get($atributo)
    {
        return $this->$atributo;
    }
}