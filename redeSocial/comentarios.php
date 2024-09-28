<!DOCTYPE html>
<html lang="pt-BR" data-bs-theme="dark">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Postagens</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body style="background-color: #1f1f1f">

    <br>
    <center>
        <h2>Post</h2>
    </center>
    <div class='container '>
        <?php

        include("bd/conexao.php");
        session_start();


        if (!isset($_SESSION['idSessao']) && !isset($_SESSION['idPostagem'])) {

            header('Location: para_voce.php');
            exit();
        }

        $idUsuarioLogado = $_SESSION['idSessao'];
        $idPostagemComent = $_SESSION['idPostagem'];

        $sql = "select Nome from Usuario where id_Usuario = $idUsuarioLogado";
        $result = mysqli_query($conexao, $sql);

        if (mysqli_num_rows($result) > 0) {
            $user = mysqli_fetch_assoc($result);
            $nome = $user['Nome'];
        }

        echo "<center><small>Logado como <b>$nome</b></small></center><br>";

        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['curtir'])) {


            $sqlCheckCurtida = "select * FROM Curtida WHERE Usuario_id_Usuario = $idUsuarioLogado AND Postagem_idPostagem = $idPostagemComent";
            $resultCheckCurtida = mysqli_query($conexao, $sqlCheckCurtida);

            if (mysqli_num_rows($resultCheckCurtida) == 0) {

                $sqlCurtir = "insert INTO Curtida (Usuario_id_Usuario, Postagem_idPostagem) VALUES ($idUsuarioLogado, $idPostagemComent)";
                mysqli_query($conexao, $sqlCurtir);
                echo "<center><p>Você curtiu a postagem!</p></center>";
            } else {
                echo "<center><p>Você já curtiu essa postagem.</p></center>";
            }
        }



        $sql = "select p.idPostagem, p.Conteudo, p.Data_Hora_Postagem, u.Nome 
            FROM Postagem p 
            INNER JOIN Usuario u ON p.Usuario_id_Usuario = u.id_Usuario 
             where p.idPostagem = $idPostagemComent
            ORDER BY p.Data_Hora_Postagem DESC";



        $result = mysqli_query($conexao, $sql);


        if (mysqli_num_rows($result) > 0) {

            while ($row = mysqli_fetch_assoc($result)) {
                $idPostagem = $row['idPostagem'];


                $sqlCurtidas = "select COUNT(*) as totalCurtidas FROM Curtida WHERE Postagem_idPostagem = $idPostagem";
                $resultCurtidas = mysqli_query($conexao, $sqlCurtidas);
                $totalCurtidas = mysqli_fetch_assoc($resultCurtidas)['totalCurtidas'];

                echo "<div class='card mx-auto p-2' style='background-color: #2f2f2f; border-color= transparent; width: 40rem; padding-left: 10px'";
                echo "<br><br><h4>" . $row['Nome'] . " postou:</h4>";
                echo "<p>" . $row['Conteudo'] . "</p>";
                echo "";


                echo "<div class='row'> <div class='col'><form method='POST' action='comentarios.php'>
                <input type='hidden' name='idPostagem' value='$idPostagem'>
                <button type='submit' name='curtir' class='btn btn-primary'>Curtir</button>&nbsp&nbspCurtidas: $totalCurtidas
              </form></div>";

                echo "</div>";
                echo "<br><small>Data da postagem: " . $row['Data_Hora_Postagem'] . "</small>";
                echo "<br></div><br>
                
                        <center>
            <a href='comentario.php' class='btn btn-primary'>Comentar</a>
            <a href='para_voce.php' class='btn btn-primary'>Voltar</a>
        </center>
                
                <hr> 
                <center>
                 <h4>Comentários</h4>
                 </center><br>";
            }
        } else {
            echo "<center>Nenhuma postagem encontrada.</center>";
        }



        $sql2 = "select c.idComentario, c.Conteudo, c.Data_Hora_Comentario, u.Nome
    FROM Comentario c 
    INNER JOIN Usuario u ON c.Usuario_id_Usuario = u.id_Usuario 
    INNER JOIN Postagem p ON c.Postagem_idPostagem = p.idPostagem 
    where c.Postagem_idPostagem = $idPostagemComent
    ORDER BY c.Data_Hora_Comentario DESC";



        $result2 = mysqli_query($conexao, $sql2);


        if (mysqli_num_rows($result2) > 0) {

            while ($row = mysqli_fetch_assoc($result2)) {

                echo "<div class='card mx-auto p-2' style='background-color: #2f2f2f; border-color= transparent; width: 34rem; padding-left: 10px'";
                echo "<br><br><h4>" . $row['Nome'] . " comentou:</h4>";
                echo "<p>" . $row['Conteudo'] . "</p>";
                echo "<small>Data do comentário: " . $row['Data_Hora_Comentario'] . "</small>";
                echo "<br></div><br>";
            }
        } else {
            echo "<center>Nenhum comentario encontrado.</center>";
        }
        ?>

        <br>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>