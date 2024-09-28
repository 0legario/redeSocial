<!DOCTYPE html>
<html lang="pt-BR" data-bs-theme="dark">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Rede Social</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body style="background-color: #1f1f1f">
    <br><br>
    <center>
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="card" style="width: 30rem; background-color:#2f2f2f; border-color: transparent;">
                        <center>
                            <br>
                            <h2>Login</h2>
                            <br>

                            <form method="POST">
                                Email<br><input type="text" name="email">
                                <br><br>
                                Senha<br><input type="password" name="pwd">
                                <br><br>
                                <input type="submit" value="Login" class="btn btn-primary">
                                <a href='index.php' class='btn btn-primary'>Voltar</a>
                                <br><br>
                            </form>
                        </center>
                    </div>

                </div>

                <div class="col">
                    <br><br>
                    <img src="img/bola_fut.png" width="200" height="200">
                </div>
            </div>
        </div>
    </center>
    <br>

    <?php
    include("bd/conexao.php");
    if ($_POST) {
        $email = $_POST['email'];
        $senha = $_POST['pwd'];

        $sql = "select Senha, id_Usuario from Usuario where Email = '$email'";
        $result = mysqli_query($conexao, $sql);

        if (mysqli_num_rows($result) > 0) {
            $user = mysqli_fetch_assoc($result);
            $senhaUser = $user['Senha'];
            $userId = $user['id_Usuario'];

            if ($senhaUser == $senha) {
                echo "<center>Login realizado com sucesso!</center>";

                session_start();
                $_SESSION["idSessao"] = $userId;

                header('Location: para_voce.php');
                exit();
            } else {
                echo "<center>Login falhou. Senha incorreta.</center>";
            }
        } else {
            echo "<center>Usuário não encontrado.</center>";
        }
    }
    ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>