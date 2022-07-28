<?php

namespace Deivz\TratamentoArquivosCsv\controllers;

use Deivz\TratamentoArquivosCsv\infrastructure\Conexao;
use PDO;

class PaginaTransacoes extends Renderizador
{
    public function processarRequisicao()
    {
        echo $this->renderizarPagina('/transacoes');
        var_dump($this->mostrarTransacoes());
    }

    public function mostrarTransacoes()
    {
        $conexao = Conexao::conectar();

        $sqlQuery = 'SELECT * FROM transacoes';
        $stmt = $conexao->query($sqlQuery);
        $transacoes = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $transacoes;
    }

}