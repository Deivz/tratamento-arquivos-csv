<?php

namespace Deivz\TratamentoArquivosCsv\controllers;

class Formulario extends Renderizador
{
    public function processarRequisicao(){
        echo $this->renderizarPagina('/formulario');
        $this->mostrarNomeDoArquivo($_FILES['arquivo']);
        $this->mostrarTamanhoDoArquivo($_FILES['arquivo']);
    }

    public function mostrarNomeDoArquivo($arquivo){
        echo "<script>console.log('{$arquivo['name']}');</script>";
    }

    public function mostrarTamanhoDoArquivo($arquivo){
        echo "<script>console.log('{$arquivo['size']}');</script>";
    }
}