<?php
include "conexao.php";

$titulo = $_POST['titulo'];
$artista = $_POST['artista'];
$ano = $_POST['ano'];
$tecnica = $_POST['tecnica'];
$descricao = $_POST['descricao'];
$caminhoArquivo ='';


if (isset($_FILES['imagem']) && $_FILES['imagem']['error'] === UPLOAD_ERR_OK) {
    // Informações do arquivo
    $arquivoTmp = $_FILES['imagem']['tmp_name'];
    $nomeArquivo = $_FILES['imagem']['name'];
    $tamanhoArquivo = $_FILES['imagem']['size'];
    $tamanhoMaximo = 2 * 1024 * 1024; // 2 MB
    if ($tamanhoArquivo > $tamanhoMaximo) {
        die("Erro: O arquivo excede o tamanho máximo permitido de 2 MB.");
    }

    $extensoesPermitidas = ['jpg', 'jpeg', 'png', 'gif'];
    $extensao = strtolower(pathinfo($nomeArquivo, PATHINFO_EXTENSION));

    if (!in_array($extensao, $extensoesPermitidas)) {
        die("Erro: Formato de arquivo não permitido. Apenas imagens (jpg, jpeg, png, gif) são aceitas.");
    }
    $pastaDestino = 'imagens/';
    if (!is_dir($pastaDestino)) {
        mkdir($pastaDestino, 0755, true); // Cria a pasta, se não existir
    }

    $caminhoArquivo = $pastaDestino . uniqid('arte_', true) . '.' . $extensao;

    if (!move_uploaded_file($arquivoTmp, $caminhoArquivo)) {
        die("Erro: Não foi possível mover o arquivo para a pasta de destino.");
    }
} else {
    die("Erro: Nenhuma imagem foi enviada ou ocorreu um erro durante o upload.");
}

$sql->query("INSERT INTO artes ( id ,titulo , descricao , artista , ano , tecnica , imagem ) values (default,'$titulo','$descricao','$artista','$ano','$tecnica','$caminhoArquivo')");

header('Location: ../html/arte.html');
exit();

?> 