<?php
include 'conexao.php';
$codigo = $_GET['codigo'];

$query = $sql->query("SELECT * FROM artes WHERE id=$codigo");
$arte = $query->fetch_assoc();

if (!$arte) {
    die("Arte não encontrada.");
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $titulo = $_POST['titulo'];
    $artista = $_POST['artista'];
    $ano = $_POST['ano'];
    $tecnica = $_POST['tecnica'];
    $descricao = $_POST['descricao'];

    if (isset($_FILES['imagem']) && $_FILES['imagem']['error'] === UPLOAD_ERR_OK) {
        $imagem = $_FILES['imagem'];

        $maxBytes = 2 * 1024 * 1024; // 2MB
        if ($imagem['size'] > $maxBytes) {
            die('A imagem excede o limite de 2MB.');
        }

        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $mime = finfo_file($finfo, $imagem['tmp_name']);
        finfo_close($finfo);

        $mimePermitidos = [
            'image/jpeg' => 'jpg',
            'image/png'  => 'png',
            'image/gif'  => 'gif',
            'image/webp' => 'webp'
        ];

        if (!isset($mimePermitidos[$mime])) {
            die('Arquivo inválido. Envie uma imagem JPG, PNG, GIF ou WEBP.');
        }

        $ext = $mimePermitidos[$mime];
        $nomeUnico = 'arte_' . uniqid('', true) . '.' . $ext;
        $caminhoDestino = 'imagens/' . $nomeUnico;

        if (!move_uploaded_file($imagem['tmp_name'], $caminhoDestino)) {
            die('Falha ao salvar a imagem enviada.');
        }

        if (!empty($arte['imagem']) && file_exists($arte['imagem'])) {
            @unlink($arte['imagem']);
        }

        $caminhoArquivo = $caminhoDestino;
    } else {
        $caminhoArquivo = $arte['imagem'];
    }

    $sql->query("UPDATE artes SET titulo='$titulo', artista='$artista', ano='$ano', tecnica='$tecnica', descricao='$descricao', imagem='$caminhoArquivo' WHERE id=$codigo");
    
    header('Location: listar_arte.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>cadastro arte</title>
    <link rel="stylesheet" href="../css/arte.css"   >


</head>
<body>
    <div id="cima">
<img src="../imagens/Lyfers.png"  id="logo">
<button class="botao" id="firstbotao" onclick="location.href='../index.html'">Inicio</button>
<button class="botao" id="secondbotao" onclick="location.href='artista.html'">Cadastrar Artista</button>
<button class="botao" id="thirdbotao" onclick="location.href='arte.html'">Cadastrar Arte</button>
<button class="botao" id="fourthbotao" onclick="location.href='../php/listar_artista.php'">Listar Artista</button>
<button class="botao" id="fifthbotao" onclick="location.href='../php/listar_arte.php'">Listar Arte</button>
</div>

        <form action="editar_arte.php?codigo=<?php echo $codigo; ?>" method="POST" id="ca" enctype="multipart/form-data">
            <h2>Editar Artes </h2>
        
            <label id="titulo1" class="labels">Título da Pintura</label>
            <input type="text" id="titulo" name="titulo" required class="inputs" value="<?php echo htmlspecialchars($arte['titulo']); ?>">

            <label id="artista1" class="labels">Nome do Artista</label>
            <input type="text" id="artista" name="artista" required class="inputs" value="<?php echo htmlspecialchars($arte['artista']); ?>">

            <label id="ano1" class="labels">Ano de Criação</label>
            <input type="text" id="ano" name="ano"  required class="inputs" value="<?php echo htmlspecialchars($arte['ano']); ?>">

            <label id="tecnica1" class="labels">Técnica Utilizada</label>
            <input type="text" id="tecnica" name="tecnica" class="inputs" value="<?php echo htmlspecialchars($arte['tecnica']); ?>">

            <label id="descricao" class="labels">Descrição</label>
            <textarea id="descricao1" name="descricao" rows="4"><?php echo htmlspecialchars($arte['descricao']); ?></textarea>

            <div id="div_submit">
                <label for="imagem" class="labels">Imagem da arte</label>
                <input type="file" name="imagem" id="imagem" accept="image/*">
                
            <button type="submit">Editar Arte</button></div>
            </form>
     
</body>
</html>

