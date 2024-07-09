<?php 

include_once('conexao.php');

$id_usuario = $_GET['id_usuario'];
$id_sessao = $_SESSION['id_usuario'];

if($id_sessao != $id_usuario){


$query = "update perfil set visitas = visitas + 1 where usuario=:id_usuario";
$stmt = $conexao->prepare($query);
$stmt->bindParam(':id_usuario', $id_usuario);
$stmt->execute();
} else {
    return false;
}




?>