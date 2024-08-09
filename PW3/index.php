<?php
// Conexão com o banco de dados
$servername = "localhost";
$username = "root"; // Seu usuário do MySQL
$password = ""; // Sua senha do MySQL
$dbname = "produtos_db";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}

// Função para cadastrar produto
if (isset($_POST['cadastrar'])) {
    $nome = $_POST['nome'];
    $descricao = $_POST['descricao'];
    $preco = $_POST['preco'];
    $quantidade = $_POST['quantidade'];

    $sql = "INSERT INTO produtos (nome, descricao, preco, quantidade) VALUES ('$nome', '$descricao', '$preco', '$quantidade')";
    
    if ($conn->query($sql) === TRUE) {
        echo "Produto cadastrado com sucesso!";
    } else {
        echo "Erro: " . $sql . "<br>" . $conn->error;
    }
}

// Função para editar produto
if (isset($_POST['editar'])) {
    $id = $_POST['id'];
    $nome = $_POST['nome'];
    $descricao = $_POST['descricao'];
    $preco = $_POST['preco'];
    $quantidade = $_POST['quantidade'];

    $sql = "UPDATE produtos SET nome='$nome', descricao='$descricao', preco='$preco', quantidade='$quantidade' WHERE id='$id'";
    
    if ($conn->query($sql) === TRUE) {
        echo "Produto atualizado com sucesso!";
    } else {
        echo "Erro: " . $sql . "<br>" . $conn->error;
    }
}

// Função para excluir produto
if (isset($_POST['excluir'])) {
    $id = $_POST['id'];

    $sql = "DELETE FROM produtos WHERE id='$id'";
    
    if ($conn->query($sql) === TRUE) {
        echo "Produto excluído com sucesso!";
    } else {
        echo "Erro: " . $sql . "<br>" . $conn->error;
    }
}

// Função para listar todos os produtos
$sql = "SELECT * FROM produtos";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciamento de Produtos</title>
    <link rel="stylesheet" href="css/style.css">

</head>

<body>
    <h2>Cadastrar Produto</h2>
    <form method="POST">
        <label for="nome">Nome:</label><br>
        <input type="text" id="nome" name="nome" required><br>
        
        <label for="descricao">Descrição:</label><br>
        <textarea id="descricao" name="descricao" required></textarea><br>

        <label for="preco">Preço:</label><br>
        <input type="number" id="preco" name="preco" step="0.01" required><br>

        <label for="quantidade">Quantidade:</label><br>
        <input type="number" id="quantidade" name="quantidade" required><br><br>

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
        <?php
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row['id'] . "</td>";
                echo "<td>" . $row['nome'] . "</td>";
                echo "<td>" . $row['descricao'] . "</td>";
                echo "<td>" . $row['preco'] . "</td>";
                echo "<td>" . $row['quantidade'] . "</td>";
                echo "<td>
                        <form method='POST' style='display:inline-block;'>
                            <input type='hidden' name='id' value='" . $row['id'] . "'>
                            <input type='submit' name='excluir' value='Excluir'>
                        </form>
                        <form method='POST' style='display:inline-block;'>
                            <input type='hidden' name='id' value='" . $row['id'] . "'>
                            <input type='text' name='nome' value='" . $row['nome'] . "' required>
                            <input type='text' name='descricao' value='" . $row['descricao'] . "' required>
                            <input type='number' name='preco' value='" . $row['preco'] . "' step='0.01' required>
                            <input type='number' name='quantidade' value='" . $row['quantidade'] . "' required>
                            <input type='submit' name='editar' value='Editar'>
                        </form>
                      </td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='6'>Nenhum produto encontrado</td></tr>";
        }
        ?>
    </table>
</body>
</html>

<?php
$conn->close();
?>
