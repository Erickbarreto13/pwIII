<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produtos</title>
</head>
<body>
    <table>
        <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>Ação</th>
        </tr>
        <?php
        foreach ($produtos as $produto) {
            echo "<tr>";
            echo "<td>" . $produto['id'] . "</td>";
            echo "<td>" . $produto['nome'] . "</td>";
            echo "<td><a href='exclusão.php?id=" . $produto['id'] . "'>Excluir</a></td>";
            echo "</tr>";
        } 
        ?>
    </table>
</body>
</html>

<?php
$servername = "localhost";
$username = "";
$password = "";
$dbname = "";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "DELETE FROM nome da tabela WHERE id = ?";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        echo "Registro excluído com sucesso.";

        header("Location: nome da tabela.php");
    } else {
        echo "Erro ao excluir o produto: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>