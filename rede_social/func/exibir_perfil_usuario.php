<?php 

include_once ('conexao.php');

if(isset($_GET['id_usuario'])){
$id_usuario= $_GET['id_usuario'];

$query= "SELECT COUNT(usuario_seguido) AS total_seguidores FROM seguidores WHERE usuario_seguido = :usuario_seguido";
$stmt = $conexao->prepare($query);
$stmt->bindParam(':usuario_seguido',$id_usuario);
$stmt->execute();
$result = $stmt->fetch(pdo::FETCH_ASSOC);
if($result){
    $total_seguidores = $result['total_seguidores'];
    $query=" update perfil set seguidores=:total_seguidores where usuario=:usuario";
    $stmt= $conexao->prepare($query);
    $stmt->bindParam(':total_seguidores',$total_seguidores);
    $stmt->bindParam(':usuario',$id_usuario);
    $stmt->execute();

    



$query="SELECT 
perfil.id_perfil,
perfil.usuario,
perfil.visitas,
perfil.seguidores,
perfil.bio,
perfil.foto,
usuario.nome,
usuario.id_usuario,
seguidores.id_seguidores,  
seguidores.seguidor  
FROM 
    perfil
INNER JOIN 
    usuario ON perfil.usuario = usuario.id_usuario
left JOIN 
    seguidores ON usuario.id_usuario = seguidores.usuario_seguido 
WHERE 
    perfil.usuario = :u";

$stmt= $conexao->prepare($query);
$stmt->bindParam(':u', $id_usuario);
$stmt->execute();
$result= $stmt->fetch(pdo::FETCH_ASSOC);


}}
?>