<?php 
session_start();
if(!isset($_SESSION['id_usuario']) && !isset($_SESSION['email']) && !isset($_SESSION['nome']) ){
    header('Location: ../login.php');
}
include_once('func/verificar_curtida.php');
include_once('func/listarfeed_perfil_usuario.php');

include_once('func/exibir_perfil_usuario.php');

include_once('func/contador_visitas.php');



$id_usuario = $_SESSION['id_usuario'];
$nome = $_SESSION['nome'];
$email = $_SESSION['email'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil do Usuário</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="func/style.css">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="index.php">Inicio</a>
    <div class="collapse navbar-collapse">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item"><a class="nav-link" href="index.php">Inicio</a></li>
            <li class="nav-item"><a class="nav-link" href="func/logout.php">Sair</a></li>
        </ul>
    </div>
</nav>

<div class="container mt-4">
    <div class="row">
        <div class="col-md-4">
            <div class="card mb-4">
                <div class="card-header">PERFIL</div>
                <div class="card-body">
                    <?php 
                    if($result){
                        echo "<div class='card mb-3'>";
                        echo "<img class='profile-picture img-thumbnail' src='" . htmlspecialchars($result["foto"], ENT_QUOTES) . "' alt='Avatar do Usuário'>";
                        echo "</div>";
                        echo "<p><strong>Nome:</strong> " . ucwords($result["nome"]) . "</p>";
                        echo "<p><strong>Bio:</strong> " . $result["bio"] . "</p>";
                        echo "<p><strong>Visitas:</strong> " . $result["visitas"] . "</p>";
                        echo "<p><strong>Seguidores:</strong> " . $result["seguidores"] . "</p>";
                        if($result['id_usuario'] !== $id_usuario){
                            if($result['seguidor'] == $id_usuario){
                                echo "<a href='func/deixar_seguir.php?id_usuario={$result['id_usuario']}' class='btn btn-secondary'>Deixar de seguir</a>";
                            } else {
                                echo "<a href='func/seguir.php?id_usuario={$result['id_usuario']}' class='btn btn-primary'>Seguir</a>";
                            }
                        }
                    }
                    ?>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Publicações de <?php if($result){ echo ucwords($result["nome"]); } ?></div>
                <div class="card-body">
                    <?php 
                    foreach ($feed as $publicado){
                        echo "<div class='card mb-3'>";
                        echo "<div class='card-body'>";
                        echo "<div class='media'>";
                        echo "<img class='profile-picture img-thumbnail mr-3' src='" . htmlspecialchars($publicado["foto"], ENT_QUOTES) . "' alt='Avatar do Usuário' width='60'>";
                        echo "<div class='media-body'>";
                        echo "<h5 class='mt-0'>" . ucwords($publicado["nome"]) . "</h5>";
                        echo "<p>" . $publicado["post_conteudo"] . "</p>";
                        echo "<p><small>" . $publicado["data_post"] . "</small></p>";
                        echo "<p><small>Curtidas: " . $publicado["total_curtidas"] . "</small></p>";

                        if (isset($verif_usuario) && isset($verif_id) && $verif_usuario == $id_usuario && $publicado['id_post'] == $verif_id){
                            
                            echo "<a href='func/descurtir.php?id={$publicado['id_post']}&id_usuario=$id_usuario' class='btn btn-secondary btn-sm'>Descurtir</a>";
                        } else {
                            
                            echo "<a href='func/curtir.php?id={$publicado['id_post']}&id_usuario=$id_usuario' class='btn btn-primary btn-sm'>Curtir</a>";
                        }
                        echo "</div>";
                        echo "</div>";
                        echo "</div>";
                        echo "</div>";
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="script/curtir.js"></script>
</body>
</html>
