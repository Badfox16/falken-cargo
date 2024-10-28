<?php
require_once '../../dao/UsuarioDAO.php'; 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    $usuarioDAO = new UsuarioDAO();
    $usuario = $usuarioDAO->login($email, $senha);

    if ($usuario) {
        // Iniciar sessão e redirecionar para a página inicial
        session_start();
        $_SESSION['usuario'] = $usuario;
        header('Location: ../../public/usuario/index.php');
        exit();
    } else {
        $error = 'Email ou senha inválidos.';
    }
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="../../assets/css/bootstrap.css">
</head>
<body>
    <div class="container">
        <h2 class="mt-5">Login</h2>
        <?php if (isset($error)): ?>
            <div class="alert alert-danger"><?php echo $error; ?></div>
        <?php endif; ?>
        <form method="POST" action="">
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="senha">Senha</label>
                <input type="password" class="form-control" id="senha" name="senha" required>
            </div>
            <button type="submit" class="btn btn-primary mt-3">Entrar</button>
        </form>
    </div>
</body>
</html>