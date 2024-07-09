<?php 
session_start();
include_once('conexao.php');

if(isset($_POST['logar'])){

$email=$_POST['email'];
$senha=$_POST['senha'];




if(filter_var($email,FILTER_VALIDATE_EMAIL)){

$query = "select email from usuario where email = :email";
$stmt=  $conexao->prepare($query);
$stmt->bindParam(':email',$email);
$stmt->execute();
$resulta = $stmt->fetch(pdo::FETCH_ASSOC);
if($resulta > 1){

       
$query = "select 
usuario.id_usuario,
usuario.nome,
usuario.email,
usuario.senha,
perfil.foto
from usuario 
inner join perfil on usuario.id_usuario = perfil.usuario
where email = :email";
$stmt= $conexao->prepare($query);
$stmt->bindParam(':email',$email);
$stmt->execute();
$result = $stmt->fetch(PDO::FETCH_ASSOC);
if($result){
$id_usuario= $result['id_usuario'];
$nome_usuario = $result['nome'];
$hash_usuario = $result['senha'];
$email_usuario = $result['email'];
$foto_usuario = $result['foto'];


 
if(password_verify($senha,$hash_usuario)){
    $_SESSION['nome'] = $nome_usuario;
    $_SESSION['id_usuario']= $id_usuario;
    $_SESSION['email']= $email_usuario;
    $_SESSION['foto']=$foto_usuario;
    header('Location: ../index.php');
    exit;
} else{
    $message = "Senha inválida";
    header("Location: ../login.php?message=" . urlencode($message));
    exit;
}

}

}else{
    $message = "Email nao existe";
    header("Location: ../login.php?message=" . urlencode($message));
    exit; 
}
} else {
    $message = "Email inválido";
    header("Location: ../login.php?message=" . urlencode($message));
    exit;
}

}








?>