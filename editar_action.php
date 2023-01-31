<?php
require 'includes/header.php';

require 'config.php';

$usuario = [];
$id = filter_input(INPUT_POST, 'id');
$nome = filter_input(INPUT_POST, 'nome');
$email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
$observacao = filter_input(INPUT_POST, 'observacao');

if($id && $nome && $email){
    $sql = $pdo->prepare("UPDATE usuarios SET nome = :nome, email = :email, observacao = :observacao WHERE id = :id");
    $sql->bindValue(':nome', $nome);
    $sql->bindValue(':email', $email);
    $sql->bindValue(':id', $id);
    $sql->bindValue(':observacao', $observacao);
    $sql->execute();

    header("Location: index.php");
    exit;
} else {
    header("Location: index.php");
    exit;
}