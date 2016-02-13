<?php require_once 'cabecalho.php' ?>
<?php require_once 'conecta.php' ?>
<?php require_once 'banco-produto.php' ?>

<?php
    $produtos = listaProdutos($conexao);
?>

<table class="table table-striped table-bordered">
<?php
    foreach($produtos as $produto) :
?>
    <tr>
        <td><?= $produto->getNome() ?></td>
        <td><?= $produto->getPreco() ?></td>
        <td><?= $produto->subtraiDesconto(0.1) ?></td>
        <td><?= substr($produto->getDescricao(), 0, 40) ?></td>
        <td><?= $produto->getCategoria()->getNome() ?></td>
        <td>
            <a href="produto-formulario.php?id=<?=$produto->getId() ?>" class="btn btn-primary" >Alterar</a>
        </td>
        <td>
            <form action="remove-produto.php" method="post">
                <input type="hidden" name="id" value="<?=$produto->getId() ?>" />
                <button class="btn btn-danger">Remover</button>
            </form>
        </td>
    </tr>
<?php
    endforeach
?>

<?php if (array_key_exists("removido", $_GET) && $_GET['removido']=='true') { ?>
    <p class="alert-success">Produto apagado com sucesso.</p>
<?php } ?>

</table>

<?php require_once 'rodape.php' ?>
