<?php

namespace Deivz\TratamentoArquivosCsv\controllers;

use Deivz\TratamentoArquivosCsv\infrastructure\Conexao;
use PDO;

class PaginaImportacoes extends Renderizador
{
    public function processarRequisicao()
    {
        $this->mostrarImportacoes();
        echo $this->renderizarPagina('/importacoes');
    }

    public function mostrarImportacoes()
    {
        $conexao = Conexao::conectar();
        $sqlQuery = 'SELECT * FROM importacoes';
        $stmt = $conexao->query($sqlQuery);
        $importacoes = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $this->console_log($importacoes);
        return $_SESSION['importacoes'] = $importacoes;
    }

    public function console_log($dados)
    {
        echo '<script>';
        echo 'console.log(' . json_encode($dados) . ')';
        echo '</script>';
    }
}
