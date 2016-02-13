<?php ob_start()?>
<?php require_once 'cabecalho.php' ?>
<?php require_once 'conecta.php' ?>
<?php require_once 'banco-categoria.php' ?>
<?php require_once 'banco-produto.php' ?>
<?php
require_once 'logica-usuario.php';
verificaUsuario();

$produto = new Produto();
$produto->setCategoria(new Categoria());
$action = "adiciona-produto.php";
if(array_key_exists('id', $_GET)) {
    $id = $_GET['id'];
    $produto = buscaProduto($conexao, $id);
    $ehAlteracao = true;
    $action = "alterar-produto.php";
}
?>

<?php $categorias = listaCategorias($conexao); ?>

<h1>Formulário de Cadastro</h1>
<form action=<?=$action ?> method="post">
    <div class="form-group">
        <label>Nome:</label>
        <input type="text" name="nome" class="form-control" value="<?=$produto->getNome() ?>">
    </div>
    <div class="form-group">
        <label>Preço:</label>
        <input type="number" name="preco" class="form-control" value="<?=$produto->getPreco() ?>">
    </div>
    <div class="form-group">
        <label>Categoria:</label>
        <select name="categoria_id" class="form-control">
            <?php foreach($categorias as $categoria) :
                $essaEhACategoria = $produto->getCategoria()->getId() == $categoria->getId();
                $select = $essaEhACategoria ? "selected='selected'" : "";
            ?>
                <option value="<?=$categoria->getId() ?>" <?=$select?>>
                    <?=$categoria->getNome() ?>
                </option>
            <?php endforeach ?>
        </select>
    </div>
    <div class="checkbox">
        <label>
            <?php
                $usado = $produto->isUsado() ? "checked='checked'" : "";
            ?>
            <input type="checkbox" name="usado" value="true" <?=$usado ?>> Usado
        </label>
    </div>
    <div class="form-group">
        <label>Descrição:</label>
        <textarea name="descricao" class="form-control">
            <?=$produto->getDescricao() ?>
        </textarea>
    </div>
    <?php
        $botao = $ehAlteracao ? "value='Alterar'" : "value='Cadastrar'";
    ?>
    <?php if(ehAlteracao): ?>
        <input type="hidden" name="id" value="<?=$produto->getId() ?>">
    <?php endif ?>
    <input type="submit" <?=$botao ?> class="btn btn-primary">
</form>

<?php require_once("rodape.php") ?>
