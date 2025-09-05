<?php
include "conexao.php";

$artista = $_POST['artista'];
$email = $_POST['email'];
$telefone = $_POST['telefone'];
$biografia = $_POST['biografia'];

$sql->query("INSERT INTO artista ( id , artista , email , telefone , biografia ) values (default,'$artista','$email','$telefone','$biografia')");

?> 