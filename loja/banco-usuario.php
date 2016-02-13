<?php

function buscaUsuario($conexao, $login, $senha)
{
    $login = mysqli_real_escape_string($conexao, $login);
    $senhaMD5 = md5($senha);
    $query = "select * from usuarios where login='{$login}' and senha='{$senhaMD5}'";
    $resultado = mysqli_query($conexao, $query);
    return mysqli_fetch_assoc($resultado);
}
