<?php
include 'conexao.php';
$codigo = $_GET['codigo'];
unlink($sql->query("SELECT imagem FROM artes WHERE id=$codigo")->fetch_assoc()['imagem']);
$sql->query("DELETE FROM artes WHERE id=$codigo");

header('Location: listar_arte.php');
exit();
?>