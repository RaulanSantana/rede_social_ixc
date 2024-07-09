<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="func/style.css">
    <title>Cadastro</title>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">Rede Social</a>
    </nav>

    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        Cadastro
                    </div>
                    <div class="card-body">
                        <form action="func/cadastrar.php" method="POST">
                            <div class="form-group">
                                <label for="nome">Digite seu nome:</label>
                                <input type="text" class="form-control" name="nome" required>
                            </div>
                            <div class="form-group">
                                <label for="email">Digite seu email:</label>
                                <input type="email" class="form-control" name="email" required>
                            </div>
                            <div class="form-group">
                                <label for="senha1">Digite a senha:</label>
                                <input type="password" class="form-control" name="senha1" required>
                            </div>
                            <div class="form-group">
                                <label for="senha2">Confirme a senha:</label>
                                <input type="password" class="form-control" name="senha2" required>
                            </div>
                            <button type="submit" class="btn btn-primary btn-block" name="cadastrar">Cadastrar</button>
                        </form>
                    </div>
                </div>
                <div class="text-center mt-3">
                    <a href="login.php">Voltar à página de login</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div id="myModal" class="modal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Mensagem</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
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
