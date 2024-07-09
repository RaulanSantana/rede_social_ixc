<?php 
session_start();
include_once('conexao.php');

$id_seguidor = $_SESSION['id_usuario'];
$id_usuario = $_GET['id_usuario'];




$query = "delete from seguidores where usuario_seguido = :usuario_seguido and seguidor=:seguidor";
$stmt= $conexao->prepare($query);
$stmt->bindParam(':usuario_seguido',$id_usuario);
$stmt->bindParam(':seguidor',$id_seguidor);
$stmt->execute();

header('Location: ../index.php');

?>