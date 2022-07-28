<?php

require __DIR__ . '/../vendor/autoload.php';

$caminho = $_SERVER['PATH_INFO'];

$rotas = require __DIR__ . '/../config/routes.php';

if (!array_key_exists($caminho, $rotas)){
    echo "Erro 404: a página que você está tentando acessar não existe!";
    exit();
}

session_start();

$classeControladora = $rotas[$caminho];
$controlador = new $classeControladora();
$controlador->processarRequisicao();