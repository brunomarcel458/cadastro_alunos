<?php
require 'config.php';
require 'includes/header.php';

$usuario = [];
$id = filter_input(INPUT_GET, 'id'); //GET porque está pegando dados pela URL

if($id){
    $sql = $pdo->prepare("SELECT * FROM usuarios WHERE id = :id");
    $sql->bindValue(':id', $id); //preparando a query para trocar valores do ID 
    $sql->execute(); //executa a query preparada

    if($sql->rowCount() > 0){
        $usuario = $sql->fetch(PDO::FETCH_ASSOC);
    } else{
        header("Location: index.php");
        exit;
    }
} else {
    header("Location: index.php");
}

?>
<body class="body-editar-page">
    <main>
        <div class="container-form editar">
            <div class="container-form-itself">
                <h1>Editar Aluno</h1>
                <form action="editar_action.php" method="POST">
                    <div class="mb-3">
                        <input type="hidden" name="id" value="<?= $usuario['id']; ?>"/> 
                        <!-- o hidden é para esconder -->
                        <label class="form-label my-label">Nome 
                            <input class="form-control" type="text" name="nome" value="<?= $usuario['nome']; ?>"/>
                        </label>
                    </div>
                    <div class="mb-3">
                        <label class="form-label my-label">Email 
                            <input class="form-control" type="email" name="email" value="<?=$usuario['email']; ?>"/>
                        </label>
                    </div>
                    <div class="mb-3">
                        <label class="form-label my-label">Observação:
                            <textarea class="form-control" name="observacao" cols="60" rows="5"; style="width: 100%"></textarea>
                        </label>
                    </div>
                    <div class="btn-save">
                        <input class="btn btn-warning" type="submit" value="Atualizar">
                    </div>
                </form>
            </div>
        </div>
    </main>
        <?php
        require 'includes/footer.php';
    ?>
</body>
