<?php

require __DIR__ . '/vendor/autoload.php';

use Deivz\TratamentoArquivosCsv\infrastructure\Conexao;

$pdo = Conexao::conectar();

echo "conectado";

// $pdo->exec('DROP TABLE transacoes;');

// $pdo->exec(
//     'CREATE TABLE transacoes (
//         id INTEGER PRIMARY KEY,
//         banco_origem TEXT,
//         agencia_origem TEXT,
//         conta_origem TEXT,
//         banco_destino TEXT,
//         agencia_destino TEXT,
//         conta_destino TEXT,
//         valor TEXT,
//         data_completa TEXT
//     );'
// );