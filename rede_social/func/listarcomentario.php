<?php 
include_once('conexao.php');


$query = "SELECT
    post.id_post,
    usuario.id_usuario,
    usuario.nome,
    comentarios.id_comentario,
    comentarios.comentario,
    perfil.foto
FROM
    post
INNER JOIN
    comentarios ON post.id_post = comentarios.post
INNER JOIN 
    usuario ON comentarios.usuario = usuario.id_usuario
   inner join
   perfil on usuario.id_usuario = perfil.usuario";
    $stmt= $conexao->prepare($query);
    $stmt->execute();
    $coment = $stmt->fetchAll(pdo::FETCH_ASSOC);

    return $coment;


?>