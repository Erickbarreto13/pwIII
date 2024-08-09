<?php
include 'funcoes.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['cadastrar'])) {
        cadastrarProduto($conn, $_POST['nome'], $_POST['descricao'], $_POST['preco'], $_POST['quantidade']);
    } elseif (isset($_POST['editar'])) {
        editarProduto($conn, $_POST['id'], $_POST['nome'], $_POST['descricao'], $_POST['preco'], $_POST['quantidade']);
    } elseif (isset($_POST['excluir'])) {
        excluirProduto($conn, $_POST['id']);
    }
}

$produtos = listarProdutos($conn);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciamento de Produtos</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h2>Cadastrar Produto</h2>
    <form method="POST">
        <input type="text" name="nome" placeholder="Nome" required><br>
        <textarea name="descricao" placeholder="Descrição" required></textarea><br>
        <input type="number" name="preco" placeholder="Preço" step="0.01" required><br>
        <input type="number" name="quantidade" placeholder="Quantidade" required><br><br>
        <input type="submit" name="cadastrar" value="Cadastrar">
    </form>

    <h2>Lista de Produtos</h2>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>Descrição</th>
            <th>Preço</th>
            <th>Quantidade</th>
            <th>Ações</th>
        </tr>
        <?php if ($produtos->num_rows > 0): while($row = $produtos->fetch_assoc()): ?>
            <tr>
                <td><?= $row['id'] ?></td>
                <td><?= $row['nome'] ?></td>
                <td><?= $row['descricao'] ?></td>
                <td><?= $row['preco'] ?></td>
                <td><?= $row['quantidade'] ?></td>
                <td>
                    <form method="POST" style="display:inline;">
                        <input type="hidden" name="id" value="<?= $row['id'] ?>">
                        <input type="submit" name="excluir" value="Excluir">
                    </form>
                    <form method="POST" style="display:inline;">
                        <input type="hidden" name="id" value="<?= $row['id'] ?>">
                        <input type="text" name="nome" value="<?= $row['nome'] ?>" required>
                        <input type="text" name="descricao" value="<?= $row['descricao'] ?>" required>
                        <input type="number" name="preco" value="<?= $row['preco'] ?>" step="0.01" required>
                        <input type="number" name="quantidade" value="<?= $row['quantidade'] ?>" required>
                        <input type="submit" name="editar" value="Editar">
                    </form>
                </td>
            </tr>
        <?php endwhile; else: ?>
            <tr><td colspan="6">Nenhum produto encontrado</td></tr>
        <?php endif; ?>
    </table>
</body>
</html>

<?php $conn->close(); ?>
