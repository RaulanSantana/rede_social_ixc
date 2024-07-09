<?php 
session_start();
if(!isset($_SESSION['id_usuario']) && !isset($_SESSION['email']) && !isset($_SESSION['nome']) ){
    header('Location: ../login.php');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Configurações de Conta</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="func/style.css">
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
                <div class="card mb-4">
                    <div class="card-header">Alterar Email</div>
                    <div class="card-body">
                        <form action="func/editar_email.php" method="POST">
                            <div class="form-group">
                                <label for="email">Digite o novo email:</label>
                                <input type="email" class="form-control" name="email" required>
                            </div>
                            <button type="submit" class="btn btn-primary btn-block" name="alteraremail">Alterar</button>
                        </form>
                    </div>
                </div>
                <div class="card mb-4">
                    <div class="card-header">Alterar Senha</div>
                    <div class="card-body">
                        <form action="func/editar_senha.php" method="POST">
                            <div class="form-group">
                                <label for="senhaantiga">Senha antiga:</label>
                                <input type="password" class="form-control" name="senhaantiga" required>
                            </div>
                            <div class="form-group">
                                <label for="senhanova">Senha nova:</label>
                                <input type="password" class="form-control" name="senhanova" required>
                            </div>
                            <button type="submit" class="btn btn-primary btn-block" name="alterarsenha">Alterar</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card mb-4">
                    <div class="card-header">Excluir Conta</div>
                    <div class="card-body">
                        <form action="func/deletar_conta.php" method="POST">
                            <div class="form-group">
                                <label for="emailatual">Digite seu email atual:</label>
                                <input type="email" class="form-control" name="emailatual" required>
                            </div>
                            <div class="form-group">
                                <label for="senhaatual">Digite sua senha atual:</label>
                                <input type="password" class="form-control" name="senhaatual" required>
                            </div>
                            <button type="submit" class="btn btn-danger btn-block" name="excluir">Excluir Conta</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
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
        console.log('Message from URL:', message); 
        if (message) {
            $('#modalMessage').text(message);
            $('#myModal').modal('show');
        }
    </script>
</body>
</html>
