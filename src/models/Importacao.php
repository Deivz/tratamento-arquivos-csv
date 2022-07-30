<?php

namespace Deivz\TratamentoArquivosCsv\models;

class Importacao
{
    private string $dataHoraImportacao;
    private string $dataTransacao;

    public function __construct($data)
    {
        $this->dataHoraImportacao = $this->definirFusoBrasil();
        $this->dataTransacao = $data;
    }

    public function __get($atributo)
    {
        return $this->$atributo;
    }

    public function definirFusoBrasil()
    {
        date_default_timezone_set('America/Sao_Paulo');
        return date('d/m/Y H:i:s', time());
    }
}
