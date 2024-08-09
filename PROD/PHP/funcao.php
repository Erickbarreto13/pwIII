<?php
include 'conexao.php';

function cadastrarProduto($conn, $nome, $descricao, $preco, $quantidade) {
    $sql = "INSERT INTO produtos (nome, descricao, preco, quantidade) VALUES ('$nome', '$descricao', '$preco', '$quantidade')";
    return $conn->query($sql);
}


function editarProduto($conn, $id, $nome, $descricao, $preco, $quantidade) {
    $sql = "UPDATE produtos SET nome='$nome', descricao='$descricao', preco='$preco', quantidade='$quantidade' WHERE id='$id'";
    return $conn->query($sql);
}


function excluirProduto($conn, $id) {
    $sql = "DELETE FROM produtos WHERE id='$id'";
    return $conn->query($sql);
}


function listarProdutos($conn) {
    $sql = "SELECT * FROM produtos";
    return $conn->query($sql);
}
?>
