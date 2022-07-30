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

    public function __construct(array $linha)
    {
        if ($this->verificarCampos($linha)){
            $this->bancoOrigem = $linha[0];
            $this->agenciaOrigem = $linha[1];
            $this->contaOrigem = $linha[2];
            $this->bancoDestino = $linha[3];
            $this->agenciaDestino = $linha[4];
            $this->contaDestino = $linha[5];
            $this->valor = $linha[6];
            $this->timeStamp = substr($linha[7], 0, 19);
        }else{
            $this->bancoOrigem = '';
        }      
    }

    public function __get($atributo)
    {
        return $this->$atributo;
    }

    public function verificarCampos($linha): bool
    {
        for ($i = 0; $i < count($linha); $i++) {
            if ($linha[$i] === '') {
                return false;
            }
        }

        return true;
    }
}