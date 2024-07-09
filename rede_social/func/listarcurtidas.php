<?php 
include_once('conexao.php');


$id_post = $_GET['id'];
$id_usuario = $_GET['id_usuario'];
$curtida = 1;

$query= "select * from curtidas where post =:id_post";
$stmt=$conexao->prepare($query);
$stmt->bindParam(':id_post',$id_post);
$stmt->execute();
$result = $stmt->fetch(pdo::FETCH_ASSOC);
if($result['curtidas']==$curtida && $result['usuario_curtiu']==$id_usuario ){

}


?>