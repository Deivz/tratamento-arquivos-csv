<?php

use Deivz\TratamentoArquivosCsv\controllers\FileCatcher;
use Deivz\TratamentoArquivosCsv\controllers\Formulario;
use Deivz\TratamentoArquivosCsv\controllers\PaginaImportacoes;
use Deivz\TratamentoArquivosCsv\controllers\PaginaTransacoes;

$rotas = [
    '' => Formulario::class,
    '/formulario' => FileCatcher::class,
    '/transacoes' => PaginaTransacoes::class,
    '/importacoes' => PaginaImportacoes::class
];

return $rotas;