<?php 
session_start();
include_once('conexao.php');
if(isset($_GET['id_usuario'])){

$id_seguidor = $_SESSION['id_usuario'];
$id_usuario = $_GET['id_usuario'];

$query = "select * from seguidores where seguidor = :seguidor and usuario_seguido = :usuario_seguido";
$stmt= $conexao->prepare($query);
$stmt->bindParam(':usuario_seguido',$id_usuario);
$stmt->bindParam('seguidor',$id_seguidor);
$stmt->execute();
$result = $stmt->fetch(pdo::FETCH_ASSOC);

if(!$result){
    $query = "insert into seguidores(usuario_seguido,seguidor) values (:usuario_seguido,:seguidor)";
    $stmt= $conexao->prepare($query);
    $stmt->bindParam(':usuario_seguido',$id_usuario);
    $stmt->bindParam(':seguidor',$id_seguidor);
    $stmt->execute();
    
    header('Location: ../index.php');
} else {
    
    return false;
    header('Location: ../index.php');
}








}

?>