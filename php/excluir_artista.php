<?php
include 'conexao.php';
$codigo = $_GET['codigo'];

$sql->query("DELETE FROM artista WHERE id=$codigo");
header('Location: listar_artista.php');
exit();
?>