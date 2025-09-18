<?php
include "conexao.php";

$artista = $_POST['nome'];
$email = $_POST['email'];
$telefone = $_POST['telefone'];
$biografia = $_POST['descricao'];

$sql->query("INSERT INTO artista ( id , artista , email , telefone , biografia ) values (default,'$artista','$email','$telefone','$biografia')");
// Redirecionar corretamente após salvar
header('Location: ../html/artista.html');
exit();
?>  