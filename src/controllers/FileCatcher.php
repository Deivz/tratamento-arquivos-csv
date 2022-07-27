<?php

namespace Deivz\TratamentoArquivosCsv\controllers;

use Deivz\TratamentoArquivosCsv\models\Transacao;
use Deivz\TratamentoArquivosCsv\controllers\Renderizador;

class FileCatcher extends Renderizador
{
    public function processarRequisicao()
    {
        try {
            $this->lerArquivo($_FILES['arquivo']);
        } catch (\Throwable $th) {
            // header('Location: /');
            echo "Arquivo não encontrado!";
        }

        // header('Location: /');
    }

    public function lerArquivo($arquivo)
    {
        $i = 1;
        $caminho = $arquivo['tmp_name'];
        $stream = fopen($caminho, 'r');
        while (!feof($stream)) {
            $linha = explode(',', fgets($stream));
            $transacao[$i] = new Transacao($linha[0], $linha[1], $linha[2], $linha[3], $linha[4], $linha[5], $linha[6], $linha[7]);
            echo $transacao[$i]->bancoOrigem;
            $i++;
        }
        fclose($stream);
    }
}
