<?php

namespace Deivz\TratamentoArquivosCsv\controllers;

class Formulario extends Renderizador
{
    public function processarRequisicao()
    {
        echo $this->renderizarPagina('/formulario');
    }
}
