<?php
     $servidor = "localhost";
     $usuario = "root";
     $senha = "";
     $banco = "projeto1";

    $conn = new PDO ("mysql:host=$servidor;dbname=$banco", $usuario, $senha);

?>