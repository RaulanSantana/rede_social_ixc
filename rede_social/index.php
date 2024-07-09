<?php 
session_start();
if(!isset($_SESSION['id_usuario']) && !isset($_SESSION['email']) && !isset($_SESSION['nome']) ){
    header('Location: ../login.php');
}
include_once ('func/listarfeed.php');
include_once('func/listarcomentario.php');

$nome = $_SESSION['nome'];
$id_usuario = $_SESSION['id_usuario'];
$email = $_SESSION['email'];
$dataHoraAtual = date('Y-m-d H:i:s');
$foto_perfil = $_SESSION['foto']; 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="func/style.css">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="#">Rede Social</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>   
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <a class="nav-link" href="perfil.php">Perfil</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="configuracao.php">Configuração</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="func/logout.php">Sair</a>
            </li>
        </ul>
    </div>
</nav>

<div class="container mt-4">
    <div class="row">
        <div class="col-md-3">
            <div class="card">
                <img src="<?php echo htmlspecialchars($foto_perfil); ?>" class="card-img-top" alt="Avatar do Usuário">
                <div class="card-body">
                    <h5 class="card-title"><?php echo ucwords($nome);?></h5>
                </div>
            </div>
        </div>
        <div class="col-md-9">
            <h1>Bem vindo <?php echo ucwords($nome);?></h1>
            <form action="func/postar.php" method="POST" class="mt-4">
                <div class="form-group">
                    <label for="postar_conteudo">Escreva alguma coisa:</label>
                    <textarea class="form-control" name="postar_conteudo" placeholder="O que está pensando?" rows='5'></textarea>
                </div>
                <input type="hidden" name="id" value="<?php echo $id_usuario;?>">
                <input type="hidden" name="data" value="<?php echo $dataHoraAtual;?>">
                <button type="submit" name="enviar" class="btn btn-primary">Enviar</button>
            </form>
            <div class="mt-4">
                <fieldset>
                    <legend>FEED</legend>
                    <?php 
foreach ($feed as $publicado) {
    echo "<div class='card mb-3'>";
    echo "<div class='card-body'>";
    echo "<h5 class='card-title'><a href='usuario_perfil.php?id_usuario=" . $publicado['id_usuario'] . "'>" . ucwords($publicado["nome"]) . "</a></h5>";
    echo "<img src=\"" . htmlspecialchars($publicado["foto"], ENT_QUOTES) . "\" class='img-fluid rounded-circle mb-3' alt='Avatar do Usuário' style='width: 60px; height: 60px;'>";
    echo "<p class='card-text'>" . $publicado["post_conteudo"] . "</p>";
    echo "<p class='card-text'><small class='text-muted'>" . $publicado["data_post"] . "</small></p>";
    echo "<p class='card-text'>Curtidas: <span class='like-count' data-id='{$publicado['id_post']}'>" . $publicado["total_curtidas"] . "</span></p>";

    $action = ($publicado['curtiu'] >= 1) ? 'descurtir' : 'curtir';
    $btn_class = ($publicado['curtiu'] >= 1) ? 'btn-secondary' : 'btn-primary';
    echo "<button class='btn {$btn_class} curtir-btn' data-id='{$publicado['id_post']}' data-action='{$action}' data-user-id='{$id_usuario}'>" . ucfirst($action) . "</button>";

    echo "<div class='container'>";
    echo "<a href='#' class='comment-toggle' data-id_post='{$publicado['id_post']}'>Comentar</a>";
    echo "<div class='comment-section' style='display: none;'>";
    echo "<form action='func/comentar.php' method='POST' class='comment-form'>";
    echo "<textarea class='form-control' name='comentario' placeholder='Escreva seu comentário' rows='3' style='display: none;'></textarea>";
    echo "<input type='hidden' name='id_post' value='{$publicado['id_post']}'>";
    echo "<button type='submit' name='comentar' class='btn btn-primary mt-2'>Enviar</button>";
    echo "</form>";
    echo "</div>";
    echo "</div>";

   foreach($coment as $res){
    if($publicado['id_post'] == $res['id_post']){
        echo "<a href='usuario_perfil.php?id_usuario=" . $res['id_usuario'] . "'>" . ucwords($res['nome']) . "</a>"."<br>";
        echo "<img src=\"" . htmlspecialchars($res["foto"], ENT_QUOTES) . "\" class='img-fluid rounded-circle mb-3' alt='Avatar do Usuário' style='width: 60px; height: 60px;'>";
        echo $res['comentario']."<br>";
    }
   }

    echo "</div>";
    echo "</div>";
}
?>
                </fieldset>
            </div>
        </div>
    </div>
</div>

<script src="script/curtir.js"></script>
<script src="script/comentar.js"></script>
</body>
</html>
