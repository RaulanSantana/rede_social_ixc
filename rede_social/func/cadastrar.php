<?php 
include_once ('conexao.php');
if(isset($_POST['cadastrar'])){

    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha1 = $_POST['senha1'];
    $senha2 = $_POST['senha2'];

    if($senha1 == $senha2){
     $hash = password_hash($senha1,PASSWORD_DEFAULT); 

     if(filter_var($email,FILTER_VALIDATE_EMAIL)){
      $query = "select * from usuario where email=:email";
      $stmt = $conexao->prepare($query);
      $stmt->bindParam(':email',$email);
      $stmt->execute();
      $result = $stmt->fetch(PDO::FETCH_ASSOC);
      if($result){
       $message= "email ja existe";
       header("Location: ../cadastro.php?message=" . urlencode($message));
        exit;

      } else {
        $query = "insert into usuario(nome,senha,email) values (:n,:s,:e)";
        $stmt = $conexao->prepare($query);
        $stmt->bindParam(':n',$nome);
        $stmt->bindParam(':s',$hash);
        $stmt->bindParam(':e',$email);
        $stmt->execute(); 
        $ultimo_id = $conexao->lastInsertId();
  
          

         
          $query2 = "insert into perfil(usuario,visitas,seguidores,foto) values (:usuario,0,0,'../foto_perfil/padrao.jpg')";
          $stmt2 = $conexao->prepare($query2);
          $stmt2->bindParam(':usuario',$ultimo_id);
          $stmt2->execute();

        
        
        
        $message = "cadastro realizado";
        header("Location: ../login.php?message=" . urlencode($message));
        exit;

      }

     } else {
        $message = "Tipo de email inválido";
        header("Location: ../cadastro.php?message=" . urlencode($message));
        exit;
     }


    } else{
        $message = "as senhas nao coincidem";
        header("Location: ../cadastro.php?message=" . urlencode($message));
        exit;
    }
  }



?>