<?php 
session_start();
include_once('conexao.php');


if(isset($_POST['salvar'])){

    $id_usuario = $_SESSION['id_usuario'];
   
    if(isset($_FILES['foto'])  && !empty($_FILES["foto"]["name"])){
        $diretorio = "../foto_perfil/";
        $arquivoFoto = $_FILES["foto"]["name"];
        $arquivoExtensao = pathinfo($arquivoFoto,PATHINFO_EXTENSION);
        $novoArquivo=uniqid('foto_').'.'.$arquivoExtensao;
        $caminho = $diretorio.$novoArquivo;
        if(move_uploaded_file($_FILES['foto']['tmp_name'],$caminho)){
            $foto_perfil = $caminho;
        
       

        }else{
            $message = "Falha ao enviar";
        header("Location: ../edicao_pefil.php?message=" . urlencode($message));
        exit;

        }} else {
            $foto_perfil = $_SESSION['foto'];
           
    }
   
   

    $query = "UPDATE perfil
SET foto =:foto
WHERE usuario IN (
    SELECT id_usuario
    FROM usuario
    WHERE id_usuario = :usuario
)";
    $stmt= $conexao->prepare($query);
    $stmt->bindParam(':foto',$foto_perfil);
    $stmt->bindParam(':usuario',$id_usuario);
    $stmt->execute();

    $message = "Foto enviada com sucesso";
    header("Location: ../edicao_perfil.php?message=" . urlencode($message));
    exit;
}



?>