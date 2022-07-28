<?php

namespace Deivz\TratamentoArquivosCsv\models;

use PDO;

class Transacao
{
    private PDO $conexao;
    private string $bancoOrigem;
    private string $agenciaOrigem;
    private string $contaOrigem;
    private string $bancoDestino;
    private string $agenciaDestino;
    private string $contaDestino;
    private string $valor;
    private string $timeStamp;

    public function __construct(
        PDO $conexao,
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
        $this->conexao = $conexao;
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