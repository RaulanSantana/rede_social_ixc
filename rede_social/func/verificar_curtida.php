<?php 

include_once('conexao.php');


$id_user = $_SESSION['id_usuario'];
$id_usuario = $_GET['id_usuario'];


$query = "SELECT
    post.id_post,
    post.post_conteudo,
    usuario.id_usuario,
    curtidas.usuario_curtiu
FROM
    post
INNER JOIN curtidas ON post.id_post = curtidas.post 
INNER JOIN usuario ON post.usuario = usuario.id_usuario
WHERE
    usuario.id_usuario = :id_usuario and curtidas.usuario_curtiu = :id_user";

$stmt = $conexao->prepare($query);
$stmt->bindParam(':id_usuario', $id_usuario);
$stmt->bindParam(':id_user', $id_user);

$stmt->execute();
$result = $stmt->fetch(PDO::FETCH_ASSOC);
if($result){
    $verif_id = $result['id_post'];
    $verif_usuario = $result['usuario_curtiu'];

}


?>