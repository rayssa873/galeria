<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../css/arte.css">
    <link rel="stylesheet" href="../css/listar.css">
</head>
<body>
 
<?php
        include "conexao.php";

        //Consulta ao banco de dados
        $query = $sql->query("SELECT * FROM artista");

        if(!$query){
            die("Erro ao buscar dados: " . $sql->error);
        }
    ?>
      <table border="1">
        <tr>
            <th>Código</th>
            <th>Artista</th>
            <th>Email</th>
            <th>Telefone</th>
            <th>Biografia</th>
            <th colspan="2">Ação</th>
        </tr>

        <?php

   while($row = $query->fetch_array()){
    $codigo = $row['id'];
    $artista = $row['artista'];
    $email = $row['email'];
    $telefone = $row['telefone'];
    $biografia = $row['biografia'];
    

    echo"
        <tr> 
            <td>$codigo</td>
            <td>$artista</td>
            <td>$email</td>
            <td>$telefone</td>
            <td>$biografia</td>
            <td><a href=\"editar_artista.php?codigo=$codigo\">Editar</a></td>
            <td><a href=\"excluir_artista.php?codigo=$codigo\">Excluir</a></td>
        </tr>
    ";
   }

        ?>
    
</body>
</html>