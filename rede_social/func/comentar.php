<?php 
include_once('conexao.php');
session_start();

if(isset($_POST['comentar'])){
$id_usuario = $_SESSION['id_usuario'];
$id_post=$_POST['id_post'];
$comentario = $_POST['comentario'];


$query = "insert into comentarios(post,comentario,usuario) values (:post,:comentario,:usuario)";
$stmt = $conexao->prepare($query);
$stmt->bindParam(':post',$id_post);
$stmt->bindParam(':usuario',$id_usuario);
$stmt->bindParam(':comentario',$comentario);
$stmt->execute();
header('Location: ../index.php');
}


?>