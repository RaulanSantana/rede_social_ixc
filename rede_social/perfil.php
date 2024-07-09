<?php 
session_start();
if(!isset($_SESSION['id_usuario']) && !isset($_SESSION['email']) && !isset($_SESSION['nome']) ){
    header('Location: ../login.php');
}
include_once('func/listarfeed_perfil.php');
include_once('func/exibir_perfil.php');

$id_usuario = $_SESSION['id_usuario'];
$nome = $_SESSION['nome'];
$email = $_SESSION['email'];
$foto_perfil = $_SESSION['foto'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil</title>
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
                    <a href="edicao_perfil.php" class="btn btn-primary mb-3">Editar Perfil</a>
                    <div class="card mb-3">
                        <img class="profile-picture img-thumbnail" src="<?php echo htmlspecialchars($foto_perfil); ?>" alt="Avatar do Usuário">
                    </div>
                    <?php 
                    foreach($result as $perfil){
                        echo "<p><strong>Nome:</strong> " . $perfil["nome"] . "</p>";
                        echo "<p><strong>Bio:</strong> " . $perfil["bio"] . "</p>";
                        echo "<p><strong>Visitas:</strong> " . $perfil["visitas"] . "</p>";
                        echo "<p><strong>Seguidores:</strong> " . $perfil["seguidores"] . "</p>";
                    }
                    ?>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Publicações de <?php echo ucwords($nome);?></div>
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
                        if ($publicado["curtiu"] == 1) {
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
