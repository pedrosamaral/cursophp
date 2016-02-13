<?php

require_once('produto.php');

$produto = new Produto();
$produto->id = 1;
$produto->nome = "teste";
$produto->preco = 100;
$produto->descricao = "Eh um teste";
$produto->categoria = "Meu teste";
$produto->usado = true;

var_dump($produto);

$produto->preco = $produto->subtraiDesconto(0.1);

var_dump($produto);

 ?>
