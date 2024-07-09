<?php 

include_once ('conexao.php');



$id_usuario = $_SESSION['id_usuario']; 

            $query = "SELECT
            post.id_post,
            post.post_conteudo,
            post.data_post,
            usuario.nome,
            usuario.id_usuario,
            perfil.foto,
            (SELECT COUNT(*) FROM curtidas WHERE curtidas.post = post.id_post) AS total_curtidas,
            (SELECT COUNT(*) FROM curtidas WHERE curtidas.post = post.id_post AND curtidas.usuario_curtiu = :id_usuario) AS curtiu
            FROM
            post
            INNER JOIN
            usuario ON post.usuario = usuario.id_usuario
            INNER JOIN perfil ON usuario.id_usuario = perfil.usuario
            ORDER BY
            post.data_post DESC";
$stmt = $conexao->prepare($query);
$stmt->bindParam(':id_usuario', $id_usuario, PDO::PARAM_INT);
$stmt->execute();
$feed = $stmt->fetchAll(PDO::FETCH_ASSOC);

return $feed;
?>
