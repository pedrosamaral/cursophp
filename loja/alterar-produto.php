<?php
ob_start();
require_once "cabecalho.php";
require_once 'conecta.php';
require_once 'banco-produto.php';
require_once 'logica-usuario.php';
require_once 'produto.php';
verificaUsuario();

$nome = $_POST["nome"];
$preco = $_POST["preco"];
$produto = new Produto();
$produto->setId($_POST["id"]);
$produto->setNome($nome);
$produto->setPreco($preco);
$produto->setDescricao($_POST["descricao"]);

$categoria = new Categoria();
$categoria->setId($_POST['categoria_id']);
$produto->setCategoria($categoria);
$usado = "false";
if(array_key_exists('usado', $_POST)){
    $usado = "true";
}
$produto->setUsado($usado);

if(alteraProduto($conexao, $produto)) :
?>
<p class="alert-success">
    Produto <?= $nome ?>, R$ <?= $preco ?> alterado com sucesso!
</p>
<?php
else :
?>
<p class="alert-danger">
    O produto <?= $nome; ?> não foi alterado
</p>
<?php
endif;
?>

<?php require_once("rodape.php") ?>
