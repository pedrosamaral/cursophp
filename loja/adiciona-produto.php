<?php
ob_start();
require_once "cabecalho.php";
require_once 'conecta.php';
require_once 'banco-produto.php';
require_once 'logica-usuario.php';
require_once 'produto.php';
verificaUsuario();
?>

<?php
$nome = $_POST["nome"];
$preco = $_POST["preco"];
$produto = new Produto();
$produto->setNome($nome);
$produto->setPreco($preco);
$produto->setDescricao($_POST["descricao"]);
$produto->setCategoria($_POST["categoria_id"]);
$produto->setUsado($_POST["usado"]);

if(insereProduto($conexao, $produto)) {
?>
<p class="alert-success">
    Produto <?= $nome ?>, R$ <?= $preco ?> adicionado com sucesso!
</p>
<?php
} else {
?>
<p class="alert-danger">
    O produto <?= $nome; ?> não foi adicionado
</p>
<?php
}
?>

<?php require_once("rodape.php") ?>
