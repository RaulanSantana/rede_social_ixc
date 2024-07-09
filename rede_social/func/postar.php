<?php 
session_start();
include_once('conexao.php');

if(isset($_POST['enviar'])){
    $post_conteudo = $_POST['postar_conteudo'];
    $id = $_POST['id'];
    $data_post=$_POST['data'];
    
    $query = "insert into post(post_conteudo,usuario,data_post) values (:p,:u,:d)";
    $stmt = $conexao->prepare($query);
    $stmt->bindParam(':p',$post_conteudo);
    $stmt->bindParam(':d',$data_post);
    $stmt->bindParam(':u',$id);
    $stmt->execute();
    header('Location: ../index.php');


}


?>