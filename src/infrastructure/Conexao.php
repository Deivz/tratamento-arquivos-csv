<?php

namespace Deivz\TratamentoArquivosCsv\infrastructure;

use PDO;

class Conexao
{
    public static function conectar(): PDO
    {
        $caminhoBanco = __DIR__ . '/../database/banco.sqlite';
        return new PDO("sqlite:{$caminhoBanco}");
    }
}