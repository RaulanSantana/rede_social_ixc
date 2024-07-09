<?php 
session_start();

include_once ('conexao.php');

if(isset($_POST['alterarsenha'])){
$id_usuario= $_SESSION['id_usuario'];
$senhaAntiga = $_POST['senhaantiga'];
$senhaNova= $_POST['senhanova'];

$query = "select senha from usuario where id_usuario=:usuario";
$stmt = $conexao->prepare($query);
$stmt->bindParam(':usuario',$id_usuario);
$stmt->execute();
$resultado = $stmt->fetch(pdo::FETCH_ASSOC);
if($resultado){
    $hash = $resultado['senha'];
    if(password_verify($senhaAntiga,$hash)){
       $novoHash =  password_hash($senhaNova,PASSWORD_DEFAULT);
        $queryy = "update usuario set senha = :novasenha where id_usuario=:usuario";
        $stmtt = $conexao->prepare($queryy);
        $stmtt->bindParam(':novasenha',$novoHash);
        $stmtt->bindParam(':usuario',$id_usuario);
        $stmtt->execute();
        $message= "senha alterada com sucesso";
        header("Location: ../configuracao.php?message=" . urlencode($message));
    } else{
        $message= "senha invalida";
        header("Location: ../configuracao.php?message=" . urlencode($message));
    }
} else {
    $message= "senha invalida";
        header("Location: ../configuracao.php?message=" . urlencode($message));
}

}


?>