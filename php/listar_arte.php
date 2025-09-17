
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../css/arte.css">
</head>
<body>
 
<?php
        include "conexao.php";

        //Consulta ao banco de dados
        $query = $sql->query("SELECT * FROM artes");

        if(!$query){
            die("Erro ao buscar dados: " . $sql->error);
        }
    ?>
      <table border="1">
        <tr>
            <th>Foto</th>
            <th>Código</th>
            <th>Titulo</th>
            <th>Artista</th>
            <th>Tecnica</th>
            <th>descrição</th>
            <th colspan="2">Ação</th>
        </tr>

        <?php

   while($row = $query->fetch_array()){
    $codigo = $row['id'];
    $imagem = $row['imagem'];
    $titulo = $row['titulo'];
    $artista = $row['artista'];
    $tecnica = $row['tecnica'];
    $descricao = $row['descricao'];
    
    if(!empty($imagem) && file_exists($imagem)){
        $imagemSrc = htmlspecialchars($imagem);
    }else{
        $imagemSrc = 'placeholder.jpg'; 
    }
    echo"
        <tr> 
            <td><img src='$imagemSrc' alt='arte' width='100px' height='100px'></td>
            <td>$codigo</td>
            <td>$titulo</td>
            <td>$artista</td>
            <td>$tecnica</td>
            <td>$descricao</td>
            <td><a href=\"editar.php?codigo=$codigo\">Editar</a></td>
            <td><a href=\"excluir.php?codigo=$codigo\">Excluir</a></td>
        </tr>
    ";
}

        ?>

    
</body>
</html>