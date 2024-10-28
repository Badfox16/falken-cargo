<?php
require_once '../../dao/UsuarioDAO.php'; 
session_start();

if (isset($_SESSION['usuario'])) {
    $idUsuario = $_SESSION['usuario']->getIdUsuario();
} else {
    // Redirecionar para a página de login se o usuário não estiver logado
    header('Location: ../login/');
    exit();
}

$usuarioDAO = new UsuarioDAO();
$usuario = $usuarioDAO->read($idUsuario);

if ($usuario === null) {
    die('Usuário não encontrado.');
}
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil do Usuário</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../../assets/css/bootstrap.css">
</head>

<body>
    <section class="d-flex">
        <?php include '../includes/sidebar.php'; ?>
        <div class="card-body" style="width: calc(100% - 280px); margin-left: 280px; overflow-y: scroll;">
            <h2 class="pd-4 m-5">Perfil do Usuário</h2>
            <div class="card mx-4 my-4" style="width: 18rem;">
                <div class="card-body">
                    <h5 class="card-title"><?= $usuario->getNome(); ?></h5>
                    <h6 class="card-subtitle mb-2 text-muted"><?= $usuario->getApelido(); ?></h6>
                    <p class="card-text"><strong>Email:</strong> <?= $usuario->getEmail(); ?></p>
                    <p class="card-text"><strong>Telefone:</strong> <?= $usuario->getTelefone(); ?></p>
                    <a href="#" class="card-link editButton" data-bs-toggle="modal" data-bs-target="#editModal<?= $usuario->getIdUsuario(); ?>">
                        <i class="fa fa-edit"></i> Editar
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Edit Modal -->
    <div class="modal fade" id="editModal<?= $usuario->getIdUsuario(); ?>" tabindex="-1" aria-labelledby="editModalLabel<?= $usuario->getIdUsuario(); ?>" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel<?= $usuario->getIdUsuario(); ?>">Editar Usuário</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="../../controllers/usuario/editar.php" method="post">
                        <input type="hidden" name="id_usuario" value="<?= $usuario->getIdUsuario(); ?>">
                        <div class="mb-3">
                            <label for="nome<?= $usuario->getIdUsuario(); ?>" class="form-label">Nome</label>
                            <input type="text" class="form-control" id="nome<?= $usuario->getIdUsuario(); ?>" name="nome" value="<?= $usuario->getNome(); ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="apelido<?= $usuario->getIdUsuario(); ?>" class="form-label">Apelido</label>
                            <input type="text" class="form-control" id="apelido<?= $usuario->getIdUsuario(); ?>" name="apelido" value="<?= $usuario->getApelido(); ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="email<?= $usuario->getIdUsuario(); ?>" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email<?= $usuario->getIdUsuario(); ?>" name="email" value="<?= $usuario->getEmail(); ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="telefone<?= $usuario->getIdUsuario(); ?>" class="form-label">Telefone</label>
                            <input type="text" class="form-control" id="telefone<?= $usuario->getIdUsuario(); ?>" name="telefone" value="<?= $usuario->getTelefone(); ?>" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Salvar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="../../assets/js/jquery.js"></script>
    <script src="../../assets/js/bootstrap.bundle.js"></script>
</body>

</html>
