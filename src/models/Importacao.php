<?php

namespace Deivz\TratamentoArquivosCsv\models;

class Importacao
{
    private string $dataHoraImportacao;
    private string $dataTransacao;

    public function __construct($data)
    {
        $this->dataHoraImportacao = date('d/m/Y H:i');
        $this->dataTransacao = $data;
    }

    public function __get($atributo)
    {
        return $this->$atributo;
    }
}