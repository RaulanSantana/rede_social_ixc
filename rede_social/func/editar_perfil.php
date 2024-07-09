<?php 
include_once('conexao.php');

if(isset($_POST['atualizar'])){

  

    $bio = $_POST['bio'];
    $nome = $_POST['nome'];
    $id_usuario = $_POST['id_usuario'];
   

    $query = "UPDATE perfil SET bio = :bio WHERE usuario = :id_usuario";
    $stmt = $conexao->prepare($query);
    $stmt->bindParam(':bio', $bio);
    $stmt->bindParam(':id_usuario', $id_usuario);
    $stmt->execute();


    
    $query2 = "UPDATE usuario SET nome = :nome WHERE id_usuario = :id_usuario";
    $stmt2 = $conexao->prepare($query2);
    $stmt2->bindParam(':nome', $nome);
    $stmt2->bindParam(':id_usuario', $id_usuario);
    $stmt2->execute();

    $message = "Perfil atualizado com sucesso";
    header("Location: ../edicao_perfil.php?message=" . urlencode($message));
    exit(); 
   
}
?>
