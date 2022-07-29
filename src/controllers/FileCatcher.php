<?php

namespace Deivz\TratamentoArquivosCsv\controllers;

use Deivz\TratamentoArquivosCsv\models\Transacao;
use Deivz\TratamentoArquivosCsv\controllers\Renderizador;
use Deivz\TratamentoArquivosCsv\infrastructure\Conexao;
use PDO;

class FileCatcher extends Renderizador
{
    public function processarRequisicao()
    {
        $this->verificarArquivo($_FILES['arquivo']);
        // try {
        //     $this->verificarArquivo($_FILES['arquivo']);
        // } catch (\Throwable $th) {
        //     $_SESSION['mensagemErro'] = "Arquivo não encontrado!";
        //     header('Location: /');
        // }
    }

    public function verificarArquivo($arquivo)
    {
        $caminho = $arquivo['tmp_name'];
        $stream = fopen($caminho, 'r');
        $linha = explode(',', fgets($stream));

        if (!isset($linha[7])) {
            $_SESSION['mensagemErro'] = "O arquivo enviado não possui transações, favor verificar!";
            header('Location: /');
            exit;
        }

        fclose($stream);

        $this->salvarDados($arquivo);
    }

    public function salvarDados($arquivo)
    {
        $conexao = Conexao::conectar();
        $caminho = $arquivo['tmp_name'];
        $stream = fopen($caminho, 'r');
        $i = 0;
        $j = 0;
        while (!feof($stream)) {
            $linha[$i] = explode(',', fgets($stream));

            $dataReferencia = substr($linha[0][7], 0, 10);
            $dataTransacao = substr($linha[$i][7], 0, 10);

            if ($dataReferencia === $dataTransacao && $this->verificarCampos($linha[$i]) && $this->verificarExistenciaNoBanco($conexao, $dataReferencia)) {
                $transacao[$j] = new Transacao($conexao, $linha[$i][0], $linha[$i][1], $linha[$i][2], $linha[$i][3], $linha[$i][4], $linha[$i][5], $linha[$i][6], substr($linha[$i][7], 0, 19));
                $this->inserirTransacao($conexao, $transacao[$j]);
                $j++;
                $_SESSION['mensagem'] = "Dados inseridos com sucesso!";
            }
            $i++;
        }
        fclose($stream);

        header('Location: /');
    }

    //REMOVER DAQUI E APLICAR NA CLASSE TRANSACAO
    public function verificarCampos($linha): bool
    {

        for ($j = 0; $j < count($linha); $j++) {
            if ($linha[$j] === '') {
                return false;
            }
        }

        return true;
    }

    public function verificarExistenciaNoBanco($conexao, $dataReferencia): bool
    {
        $conexao = Conexao::conectar();
        $sqlQuery = 'SELECT data_completa FROM transacoes';
        $stmt = $conexao->query($sqlQuery);
        $datasRetornadas = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($datasRetornadas as $data) {
            if (substr($data['data_completa'], 0, 10) === $dataReferencia) {
                $_SESSION['mensagemErro'] = "O lançamento para esta data já foi realizado!";
                return false;
            }
        }

        return true;
    }

    public function inserirTransacao($conexao, $transacao)
    {
        // $conexao->beginTransaction();
        $insertQuery = 'INSERT INTO transacoes (
            banco_origem,
            agencia_origem,
            conta_origem,
            banco_destino,
            agencia_destino,
            conta_destino,
            valor,
            data_completa
        ) VALUES (
            :banco_origem,
            :agencia_origem,
            :conta_origem,
            :banco_destino,
            :agencia_destino,
            :conta_destino,
            :valor,
            :data_completa
        );';
        $stmt = $conexao->prepare($insertQuery);
        $stmt->execute([
            ':banco_origem' => $transacao->bancoOrigem,
            ':agencia_origem' => $transacao->agenciaOrigem,
            ':conta_origem' => $transacao->contaOrigem,
            ':banco_destino' => $transacao->bancoDestino,
            ':agencia_destino' => $transacao->agenciaDestino,
            ':conta_destino' => $transacao->contaDestino,
            ':valor' => $transacao->valor,
            ':data_completa' => $transacao->timeStamp
        ]);
    }
}
