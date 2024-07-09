<?php 
session_start();
include_once('conexao.php');
if(isset($_POST['alteraremail'])){
    $id_usuario = $_SESSION['id_usuario'];
    $novoEmail=$_POST['email'];

    if(filter_var($novoEmail,FILTER_VALIDATE_EMAIL)){
     $query="select * from usuario where email=:email";
     $stmt= $conexao->prepare($query);
     $stmt->bindParam(':email',$novoEmail);
     $stmt->execute();
     $resultado = $stmt->fetch(pdo::FETCH_ASSOC);
     if($resultado){
        $message= "email já esta em uso";
        header("Location: ../configuracao.php?message=" . urlencode($message));
     } else {
      $queryy="update usuario set email =:novoemail where id_usuario=:id_usuario";
      $stmtt= $conexao->prepare($queryy);
      $stmtt->bindParam(':novoemail',$novoEmail);
      $stmtt->bindParam(':id_usuario',$id_usuario);
      $stmtt->execute();
      $message= "email alterado com sucesso";
      header("Location: ../configuracao.php?message=" . urlencode($message));
     }


} else {
    $message= "tipo de email invalido";
    header("Location: ../configuracao.php?message=" . urlencode($message));
}
}


?>