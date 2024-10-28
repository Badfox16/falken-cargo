<?php
require_once '../../dao/UsuarioDAO.php'; // Ajuste o caminho conforme necessário

$usuarioDAO = new UsuarioDAO();
$usuarios = $usuarioDAO->getAll();
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Usuários</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../../assets/css/bootstrap.css">
</head>

<body>
    <section class="d-flex">
        <?php include '../includes/sidebar.php'; ?>
        <div class="card-body" style="width: calc(100% - 280px); margin-left: 280px; overflow-y: scroll;">
            <h2 class="pd-4 m-5">Gerir Usuarios</h2>
            <div class="d-flex">
                <div class="mx-4 my-4">
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#cadastroUsuarioModal" style="background-color: #000; border:none;">
                        <i class="fa fa-plus-square" aria-hidden="true"></i>
                        Cadastrar Novo Usuário
                    </button>

                    <!-- Modal -->
                    <div class="modal fade" id="cadastroUsuarioModal" tabindex="-1" aria-labelledby="cadastroUsuarioModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="cadastroUsuarioModalLabel">Cadastro de Usuário</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form method="post" action="../../controllers/usuario/criar.php">
                                        <div class="mb-3">
                                            <label for="usuario" class="form-label">Nome de Usuário:</label>
                                            <input type="text" class="form-control" name="nome" placeholder="Insira o nome do usuário" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="apelido" class="form-label">Apelido:</label>
                                            <input type="text" class="form-control" name="apelido" placeholder="Insira o apelido" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="email" class="form-label">Email:</label>
                                            <input type="email" class="form-control" name="email" placeholder="Insira o email" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="telefone" class="form-label">Telefone:</label>
                                            <input type="text" class="form-control" name="telefone" placeholder="Insira o telefone" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="senha" class="form-label">Senha:</label>
                                            <input type="password" class="form-control" name="senha" placeholder="Insira a senha" required>
                                        </div>
                                        <button type="submit" class="btn btn-primary">Cadastrar</button>
                                    </form>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="">
                <table class="table table-responsive-lg table-hover table-bordered mb-0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nome</th>
                            <th>Apelido</th>
                            <th>Email</th>
                            <th>Telefone</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($usuarios as $usuario) : ?>
                            <tr style="height: 16px;">
                                <td>
                                    <span><b><?= $usuario->getIdUsuario(); ?></b></span>
                                </td>
                                <td><?= $usuario->getNome(); ?></td>
                                <td><?= $usuario->getApelido(); ?></td>
                                <td><?= $usuario->getEmail(); ?></td>
                                <td><?= $usuario->getTelefone(); ?></td>
                                <td>
                                    <a href="#" class="editButton" data-bs-toggle="modal" data-bs-target="#editModal<?= $usuario->getIdUsuario(); ?>">
                                        <span style="font-size: 1.5rem; color:#000; padding-left: 16px;" aria-hidden="true">
                                            <i class="fa fa-edit"></i>
                                        </span>
                                    </a>
                                    <a href="#" data-bs-toggle="modal" data-bs-target="#deleteModal<?= $usuario->getIdUsuario(); ?>">
                                        <span style="font-size: 1.5rem; color:#000; padding-left: 16px;" aria-hidden="true">
                                            <i class="fa fa-trash"></i>
                                        </span>
                                    </a>
                                </td>
                            </tr>

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

                            <!-- Delete Modal -->
                            <div class="modal fade" id="deleteModal<?= $usuario->getIdUsuario(); ?>" tabindex="-1" aria-labelledby="deleteModalLabel<?= $usuario->getIdUsuario(); ?>" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="deleteModalLabel<?= $usuario->getIdUsuario(); ?>">Confirmar Exclusão</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            Tem certeza que deseja excluir o usuário <b><?= $usuario->getNome(); ?></b>?
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                            <form action="../../controllers/usuario/apagar.php" method="post">
                                                <input type="hidden" name="id_usuario" value="<?= $usuario->getIdUsuario(); ?>">
                                                <button type="submit" class="btn btn-danger">Excluir</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </section>

    <script src="../../assets/js/jquery.js"></script>
    <script src="../../assets/js/bootstrap.bundle.js"></script>
</body>

</html>