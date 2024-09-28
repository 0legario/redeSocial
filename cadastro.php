<!DOCTYPE html>
<html lang="pt-BR" data-bs-theme="dark">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro Rede Social</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body style="background-color: #1f1f1f">
    <br>
    <center>
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="card" style="width: 30rem; background-color:#2f2f2f; border-color: transparent;">
                        <center>
                            <br>
                            <h2>Cadastro</h2>
                            <br>
                            <form method="post">
                                Usuário <br><input type="text" name="usern" required>
                                <br><br>
                                Email <br><input type="text" name="email" required>
                                <br><br>
                                Senha <br><input type="password" name="pwd" required>
                                <br><br>
                                <input type="submit" value="Cadastro" class="btn btn-primary">
                                <a href='index.php' class='btn btn-primary'>Voltar</a>
                                <br><br>
                            </form>
                        </center>
                    </div>
                </div>
                <div class="col">
                    <br><br><br><br>
                    <img src="img/bola_fut.png" width="200" height="200">
                </div>
            </div>
        </div>
        <br>
    </center>




    <?php
    include("bd/conexao.php");
    if ($_POST) {
        $usern =  $_POST['usern'];
        $email = $_POST['email'];
        $senha = $_POST['pwd'];


        $sql = "select nome from Usuario where Nome= '$usern'";

        $result = mysqli_query($conexao, $sql);

        if (mysqli_num_rows($result) == 0) {
            $nomeTeste = true;
        } else {
            $nomeTeste = false;
        }

        $sql = "select email from Usuario where Email= '$email'";

        $result = mysqli_query($conexao, $sql);


        if (mysqli_num_rows($result) == 0) {
            $emailTeste = true;
        } else {
            $emailTeste = false;
        }


        if ($nomeTeste && $emailTeste) {
            $sql = "insert into Usuario (Nome, Email, Senha) VALUES ('$usern', '$email', '$senha')";

            if (mysqli_query($conexao, $sql)) {
                echo ("<center>Cadastro realizado com sucesso!</center>");
            } else {
                echo ("</center>Erro: " . mysqli_error($conexao) . "</center>");
            }
        } else {
            echo ("<center>Esse usuário ou email já existe.</center>");
        }
    }
    ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</body>

</html>