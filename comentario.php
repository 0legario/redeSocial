<!DOCTYPE html>
<html lang="pt-BR" data-bs-theme="dark">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Comentario Rede Social</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body style="background-color: #1f1f1f">
    <br>
    <center>
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="card" style="background-color: #2f2f2f; border: transparent; width: 50rem;">
                        <br>
                        <center>
                            <h3>Fazer um Comentário</h3><br>

                            <form method="POST" style="padding: 10px;">
                                <input type="text" name="conteudo" class="form-control">
                                <br><br>
                                <input type="submit" value="Comentar" class="btn btn-primary">
                                <br><br>
                            </form>
                        </center>
                    </div>

                </div>
            </div>

        </div>
        <br>
        <a href="comentarios.php" class="btn btn-primary">Voltar</a>
        <br> <br>

        <?php
        include("bd/conexao.php");
        session_start();

        if (!isset($_SESSION['idSessao']) && !isset($_SESSION['idPostagem'])) {
            // Redireciona para a página de login se o usuário não estiver logado
            header('Location: para_voce.php');
            exit();
        }
        $idUsuarioLogado = $_SESSION['idSessao'];
        $idPostagemComent = $_SESSION['idPostagem'];

        if ($_POST) {
            $conteudo = $_POST['conteudo'];

            $sql = "insert into Comentario  values (default, '$conteudo', current_timestamp(), $idPostagemComent, $idUsuarioLogado)";

            if (mysqli_query($conexao, $sql)) {
                echo ("Comentário realizado com sucesso!");
            } else {
                echo ("Erro: " . mysqli_error($conexao));
            }
        }
        ?>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>