<?php
require_once 'produto.php';
require_once 'categoria.php';

function listaProdutos($conexao) {
    $produtos = array();
    $resultado = mysqli_query($conexao, "select p.*, c.nome as
                                categoria_nome from produtos as p join categorias as c on
                                p.categoria_id = c.id");
    while($array = mysqli_fetch_assoc($resultado)) {
        $produto = new Produto();
        $produto->setId($array['id']);
        $produto->setNome($array['nome']);
        $produto->setDescricao($array['descricao']);
        $produto->setPreco($array['preco']);

        $categoria = new Categoria();
        $categoria->setId($array['categoria_id']);
        $categoria->setNome($array['categoria_nome']);
        $produto->setCategoria($categoria);
        $produto->setUsado($array['usado']);
        array_push($produtos, $produto);
    }
    return $produtos;
}

function buscaProduto($conexao, $id)
{
    $resultado = mysqli_query($conexao, "select p.*, c.nome as
                                categoria_nome from produtos as p join categorias as c on
                                p.categoria_id = c.id where p.id={$id}");
    $array = mysqli_fetch_assoc($resultado);
    $produto = new Produto();
    $produto->setId($array['id']);
    $produto->setNome($array['nome']);
    $produto->setDescricao($array['descricao']);
    $produto->setPreco($array['preco']);

    $categoria = new Categoria();
    $categoria->setId($array['categoria_id']);
    $categoria->setNome($array['categoria_nome']);
    $produto->setCategoria($categoria);
    $produto->setUsado($array['usado']);

    return $produto;
}

function insereProduto($conexao, $produto) {

    if(array_key_exists('usado', $_POST)){
        $produto->setUsado("true");
    } else {
        $produto->setUsado("false");
    }

    $query = "insert into produtos (nome, preco, descricao, categoria_id, usado) "
            ."values ('{$produto->getNome()}', {$produto->getPreco()}, '{$produto->getDescricao()}', '{$produto->getCategoria()}', {$produto->isUsado()})";
    $resultadoDaInsercao = mysqli_query($conexao, $query);
    return $resultadoDaInsercao;
}

function alteraProduto($conexao, $produto)
{
    $query = "update produtos set nome='{$produto->getNome()}',".
            " preco={$produto->getPreco()},".
            " descricao='{$produto->getDescricao()}',".
            " categoria_id={$produto->getCategoria()->getId()},".
            " usado={$produto->isUsado()}".
            " where id={$produto->getId()}";

        return mysqli_query($conexao, $query);
}

function removeProduto($conexao, $id) {
    $query = "delete from produtos where id = {$id}";
    return mysqli_query($conexao, $query);
}
