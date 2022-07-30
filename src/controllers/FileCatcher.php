<?php

namespace Deivz\TratamentoArquivosCsv\controllers;

use Deivz\TratamentoArquivosCsv\models\Transacao;
use Deivz\TratamentoArquivosCsv\controllers\Renderizador;
use Deivz\TratamentoArquivosCsv\infrastructure\Conexao;
use Deivz\TratamentoArquivosCsv\models\Importacao;
use PDO;

class FileCatcher extends Renderizador
{
    public function processarRequisicao()
    {
        try {
            $conexao = Conexao::conectar();
            $this->verificarArquivo($_FILES['arquivo'], $conexao);
        } catch (\Throwable $th) {
            $_SESSION['mensagemErro'] = "Arquivo não encontrado!";
            header('Location: /');
        }
    }

    public function verificarArquivo($arquivo, $conexao)
    {
        $caminho = $arquivo['tmp_name'];
        $stream = fopen($caminho, 'r');
        $linha = explode(',', fgets($stream));
        $dataReferencia = $this->formatarData($linha[7]);

        if (!isset($linha[7])) {
            $_SESSION['mensagemErro'] = "O arquivo enviado não possui transações, favor verificar!";
            header('Location: /');
            exit;
        }

        fclose($stream);

        if($this->verificarExistenciaNoBanco($conexao, $dataReferencia)){
            $this->verificarDados($arquivo, $conexao, $dataReferencia);
            $importacao = new Importacao($dataReferencia);
            $this->inserirImportacao($conexao, $importacao);
        }
       
        header('Location: /');
    }

    public function formatarData($data)
    {
        $arrayDatas = explode('-', substr($data, 0, 19));
        $diaHora = explode('T', $arrayDatas[2]);
        $hora = substr($diaHora[1], 0, 8);
        $dia = $diaHora[0];
        $mes = $arrayDatas[1];
        $ano = $arrayDatas[0];

        return "{$dia}/{$mes}/{$ano}";
    }

    public function verificarExistenciaNoBanco($conexao, $dataReferencia): bool
    {
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

    public function verificarDados($arquivo, $conexao, $dataReferencia)
    {
        $caminho = $arquivo['tmp_name'];
        $stream = fopen($caminho, 'r');
        $i = 0;
        $j = 0;
        while (!feof($stream)) {
            $linha[$i] = explode(',', fgets($stream));
            $dataTransacao = $this->formatarData($linha[$i][7]);
            if ($dataReferencia === $dataTransacao) {
                $transacao[$j] = new Transacao($linha[$i]);
                if ($transacao[$j]->bancoOrigem != '') {
                    $this->inserirTransacao($conexao, $transacao[$j]);
                    $j++;
                    $_SESSION['mensagem'] = "Dados inseridos com sucesso!";
                }
            }
            $i++;
        }

        fclose($stream);
    }

    public function inserirTransacao($conexao, $transacao)
    {
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

    public function inserirImportacao($conexao, $importacao)
    {
        $insertQuery = 'INSERT INTO importacoes (
            datahora_importacao,
            data_transacao
        ) VALUES (
            :datahora_importacao,
            :data_transacao
        );';
        $stmt = $conexao->prepare($insertQuery);
        $stmt->execute([
            ':datahora_importacao' => $importacao->dataHoraImportacao,
            ':data_transacao' => $importacao->dataTransacao
        ]);
    }
}
