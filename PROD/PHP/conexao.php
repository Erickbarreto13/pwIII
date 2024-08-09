<?php
$conn = new mysqli("localhost", "root", "", "produtos_db");

if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}
?>
