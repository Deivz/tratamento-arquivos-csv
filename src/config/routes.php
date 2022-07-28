<?php

use Deivz\TratamentoArquivosCsv\controllers\FileCatcher;
use Deivz\TratamentoArquivosCsv\controllers\Formulario;
use Deivz\TratamentoArquivosCsv\controllers\PaginaTransacoes;

$rotas = [
    '' => Formulario::class,
    '/formulario' => FileCatcher::class,
    '/transacoes' => PaginaTransacoes::class
];

return $rotas;