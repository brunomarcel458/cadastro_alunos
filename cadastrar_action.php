<?php

require 'includes/header.php';
require 'config.php';
require 'cadastrar.php';

$nome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_SPECIAL_CHARS);
$email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
$telefone = filter_input(INPUT_POST, 'telefone', FILTER_VALIDATE_INT);
$mensalidade = filter_input(INPUT_POST, 'mensalidade', FILTER_VALIDATE_FLOAT);
$senha = password_hash($senha, PASSWORD_DEFAULT);
$situacao = $_POST['situacao'];
$observacao = $_POST['observacao'];

if(!empty($nome && $email && $telefone && $mensalidade && $senha && $situacao && $observacao)){

    if($nome && $email){
    
        $sql = $pdo->prepare("SELECT * FROM usuarios WHERE email = :email");
        $sql->bindValue(':email', $email);
        $sql->execute();
        
        //verificou em todos os usuários se haviam emails iguais
    
        if($sql->rowCount() === 0){
    
            $sql = $pdo->prepare("INSERT INTO usuarios(nome, email, telefone, situacao, mensalidade, senha, observacao) VALUES (:nome, :email, :telefone, :situacao, :mensalidade, :senha, :observacao)");
            
            $sql->bindValue(':nome', $nome);
            $sql->bindValue(':email', $email);
            $sql->bindValue(':telefone', $telefone);
            $sql->bindValue(':situacao', $situacao);
            $sql->bindValue(':mensalidade', $mensalidade);
            $sql->bindValue(':senha', $senha);
            $sql->bindValue(':observacao', $observacao);
            //montou a query
    
            $sql->execute(); //executa a query
            
            header("Location: index.php"); //retorna para a index de listagem de usuários
            exit;
    
        } else {
            header("Location: cadastrar.php");
        }
        
    } else {
        header("Location: cadastrar.php");
    }
} else{
    header("Location: cadastrar.php");
}
    
