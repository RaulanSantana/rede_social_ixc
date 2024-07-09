<?php 
session_start();
include_once('conexao.php');

if(isset($_POST['excluir'])) {
    $usuario = $_SESSION['id_usuario'];
    $email = $_POST['emailatual'];
    $senha = $_POST['senhaatual'];

    if(filter_var($email, FILTER_VALIDATE_EMAIL)) {
    
        $query = "SELECT senha FROM usuario WHERE email = :email and id_usuario = :usuario";
        $stmt = $conexao->prepare($query);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':usuario', $usuario);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if($result) {
            $hash = $result['senha'];

          
            if(password_verify($senha, $hash)) {
                try {
                 
                    $conexao->beginTransaction();

                    $query_curtidas = "DELETE FROM curtidas WHERE post IN (SELECT id_post FROM post WHERE usuario = :usuario)";
                    $stmt_curtidas = $conexao->prepare($query_curtidas);
                    $stmt_curtidas->bindParam(':usuario', $usuario);
                    $stmt_curtidas->execute();

                  
                    $query_posts = "DELETE FROM post WHERE usuario = :usuario";
                    $stmt_posts = $conexao->prepare($query_posts);
                    $stmt_posts->bindParam(':usuario', $usuario);
                    $stmt_posts->execute();

                  
                    $query_seguidores = "DELETE FROM seguidores WHERE usuario_seguido = :usuario OR seguidor = :usuario";
                    $stmt_seguidores = $conexao->prepare($query_seguidores);
                    $stmt_seguidores->bindParam(':usuario', $usuario);
                    $stmt_seguidores->execute();

                 
                    $query_perfil = "DELETE FROM perfil WHERE usuario = :usuario";
                    $stmt_perfil = $conexao->prepare($query_perfil);
                    $stmt_perfil->bindParam(':usuario', $usuario);
                    $stmt_perfil->execute();

                    $query_perfil = "DELETE FROM comentarios WHERE usuario = :usuario";
                    $stmt_perfil = $conexao->prepare($query_perfil);
                    $stmt_perfil->bindParam(':usuario', $usuario);
                    $stmt_perfil->execute();

                    $query_perfil = "DELETE FROM curtidas WHERE usuario_curtiu = :usuario";
                    $stmt_perfil = $conexao->prepare($query_perfil);
                    $stmt_perfil->bindParam(':usuario', $usuario);
                    $stmt_perfil->execute();
                   
                    $query_usuario = "DELETE FROM usuario WHERE id_usuario = :usuario";
                    $stmt_usuario = $conexao->prepare($query_usuario);
                    $stmt_usuario->bindParam(':usuario', $usuario);
                    $stmt_usuario->execute();

                    // Commit da transação
                    $conexao->commit();
                   
                    $message = "Usuario excluido com sucesso";
                    session_destroy();
                    header("Location: ../login.php?message=" . urlencode($message));
                    
                    exit;
                    
                } catch(PDOException $e) {
                    // Caso ocorra algum erro, faz rollback da transação
                    $conexao->rollback();
                    echo "Erro ao deletar usuário: " . $e->getMessage();
                }
            } else {
                $message = "Senha incorreta";
                header("Location: ../configuracao.php?message=" . urlencode($message));
                exit;
            }
        } else {
            $message = "Email incorreto";
                header("Location: ../configuracao.php?message=" . urlencode($message));
                exit;
        }
    } else {
        $message = "Email invalido";
                header("Location: ../configuracao.php?message=" . urlencode($message));
                exit;
    }
} else {
    $message = "Requisição invalida";
                header("Location: ../configuracao.php?message=" . urlencode($message));
                exit;
}
?>
