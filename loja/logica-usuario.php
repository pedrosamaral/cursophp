<?php
session_start();

function verificaUsuario()
{
    if(!isset($_SESSION["usuario_logado"])){
        header("Location: index.php?falhaDeSeguraca=true");
        die();
    }
}

function usuarioEstaLogado()
{
    return isset($_SESSION["usuario_logado"]);
}

function usuarioLogado()
{
    return $_SESSION["usuario_logado"];
}

function logaUsuario($login)
{
    $_SESSION["usuario_logado"] = $login;
}

function logout()
{
    session_destroy();
}
