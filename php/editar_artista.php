<?php
include "conexao.php";
$codigo = $_GET['codigo'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $artista = $_POST['nome'];
    $email = $_POST['email'];
    $telefone = $_POST['telefone'];
    $biografia = $_POST['descricao'];

    $sql->query("UPDATE artista SET artista='$artista', email='$email', telefone='$telefone', biografia='$biografia' WHERE id=$codigo");

    header('Location: listar_artista.php');
    exit();
} else {
    // Buscar os dados do artista para preencher o formulário
    $query = $sql->query("SELECT * FROM artista WHERE id=$codigo");
    $row = $query->fetch_array();
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>cadastro artista</title>
    <link rel="stylesheet" href="../css/artista.css">


</head>
<body>
    <div id="cima">
<img src="../imagens/Lyfers.png"  id="logo">
<button class="botao" id="firstbotao" onclick="location.href='../index.html'">Inicio</button>
<button class="botao" id="secondbotao" onclick="location.href='../artista.html'">Cadastrar Artista</button>
<button class="botao" id="thirdbotao" onclick="location.href='../arte.html'">Cadastrar Arte</button>
<button class="botao" id="fourthbotao" onclick="location.href='listar_artista.php'">Listar Artista</button>
<button class="botao" id="fifthbotao" onclick="location.href='listar_arte.php'">Listar Arte</button>
</div>
    <div id="ca">
        <h2>Editar Artista</h2>
        <form action="editar_artista.php?codigo=<?php echo $codigo; ?>" method="POST">
            <label id="titulo1" class="labels">Nome do artista</label>
            <input type="text" id="titulo" class="inputs" name="nome" required value="<?php echo htmlspecialchars($row['artista']); ?>">

            <label id="artista1" class="labels">Email</label>
            <input type="email" id="artista" class="inputs" name="email" required value="<?php echo htmlspecialchars($row['email']); ?>">

            <label id="ano1" class="labels">Numero de telefone</label>
            <input type="tel" id="ano" class="inputs" name="telefone"  required value="<?php echo htmlspecialchars($row['telefone']); ?>">

            <label id="descricao1" class="labels">Biografia</label>
            <textarea id="descricao"  name="descricao" rows="4"><?php echo htmlspecialchars($row['biografia']); ?></textarea>

            <button type="submit">Editar Artista</button>
        </form>
    </div>
    
</body>
</html>