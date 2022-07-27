<?php

use Deivz\TratamentoArquivosCsv\controllers\FileCatcher;
use Deivz\TratamentoArquivosCsv\controllers\Formulario;

$rotas = [
    '' => Formulario::class,
    '/formulario' => FileCatcher::class,
    // '/upload' => FileCatcher::class,
];

return $rotas;