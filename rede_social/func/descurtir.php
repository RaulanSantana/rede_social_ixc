<?php 
include_once('conexao.php');

if (isset($_GET['id']) && isset($_GET['id_usuario'])) {
    $id_post = $_GET['id'];
    $id_usuario = $_GET['id_usuario'];
    $curtida = 1;


    $query = "delete from curtidas where post=:id_post and curtidas=:curtida and usuario_curtiu=:id_usuario";
    $stmt = $conexao->prepare($query);
    $stmt->bindParam(':id_post', $id_post);
    $stmt->bindParam(':curtida', $curtida);
    $stmt->bindParam(':id_usuario', $id_usuario);
    $stmt->execute();
    header('Location: ../index.php');
    }
