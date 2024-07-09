<?php 
session_start();
if(!isset($_SESSION['id_usuario']) && !isset($_SESSION['nome']) && !isset($_SESSION['email'])){
    header('Location: login.php');
}
include_once('func/conexao.php');
include_once('func/exibir_perfil.php');
$id_usuario = $_SESSION['id_usuario'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="func/style.css">
    <title>Editar Perfil</title>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="index.php">Inicio</a>
        <div class="collapse navbar-collapse">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item"><a class="nav-link" href="index.php">Inicio</a></li>
                <li class="nav-item"><a class="nav-link" href="perfil.php">Perfil</a></li>
                <li class="nav-item"><a class="nav-link" href="func/logout.php">Sair</a></li>
            </ul>
        </div>
    </nav>

    <div class="container mt-4">
        <div class="row">
            <div class="col-md-6">
                <form action="func/upload_foto.php" method="POST" enctype="multipart/form-data">
                    <fieldset class="border p-4">
                        <legend class="w-auto">Alterar foto</legend>
                        <div class="form-group">
                            <label for="foto">Selecione uma foto:</label>
                            <input type="file" name="foto" accept="image/*" class="form-control-file">
                        </div>
                        <button type="submit" name="salvar" class="btn btn-primary">Salvar foto</button>
                    </fieldset>
                </form>
            </div>
            <div class="col-md-6">
                <form action="func/editar_perfil.php" method="POST">
                    <fieldset class="border p-4">
                        <legend class="w-auto">Editar perfil</legend>
                        <div class="form-group">
                            <label for="nome">Nome:</label>
                            <input type="text" name="nome" value="<?php foreach($result as $dado) echo htmlspecialchars($dado["nome"]); ?>" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="bio">Bio:</label>
                            <textarea name="bio" rows="5" class="form-control"><?php foreach($result as $dado) { echo htmlspecialchars($dado["bio"]); } ?></textarea>
                        </div>
                        <input type="hidden" name="id_usuario" value="<?php echo $id_usuario; ?>">
                        <button type="submit" name="atualizar" class="btn btn-primary">Atualizar</button>
                    </fieldset>
                </form>
            </div>
        </div>
    </div>

    <div id="myModal" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Mensagem</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p id="modalMessage"></p>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="script/modal.js"></script>
    <script>
        // Verifica se há uma mensagem na URL
        const urlParams = new URLSearchParams(window.location.search);
        const message = urlParams.get('message');
        if (message) {
            $('#myModal').modal('show');
            document.getElementById('modalMessage').textContent = message;
        }
    </script>
</body>
</html>
