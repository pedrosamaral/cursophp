<?php
ob_start();
require_once("cabecalho.php");
require_once("logica-usuario.php");
?>

<?php
if(isset($_GET["logout"]) && $_GET["logout"] == true):
?>
<p class="alert-success">Deslogado com sucesso!</p>
<?php
endif
?>

<?php
if(usuarioEstaLogado()){
?>
<p class="alert-success">
    Você está logado como <?=usuarioLogado() ?>
    <a href="logout.php">Deslogar</a>
</p>

<?php
} else {
?>

<?php
if(isset($_GET["falhaDeSeguraca"])):
?>
<p class="alert-danger">Você não tem acesso a esta funcionalidade!</p>
<?php
endif;
?>


<h2>Login</h2>
<form action="login.php" method="post">
    <div class="form-group">
        <label>Login</label>
        <input type="text" name="login" class="form-control" />
    </div>
    <div class="form-group">
        <label>Senha</label>
        <input type="password" name="senha" class="form-control" />
    </div>
    <button type="submit" class="btn btn-primary">Login</button>
</form>
<?php
}
?>

<?php require_once("rodape.php") ?>
