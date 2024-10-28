<?php
require_once '../../dao/CargaDAO.php'; 

$CargaDAO = new CargaDAO();
$Cargas = $CargaDAO->getAll();
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Falken Cargo - Cargas</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../assets/css/bootstrap.css">
</head>

<body>
    <section class="d-flex">
        <?php include '../includes/sidebar.php'; ?>
        <div class="card-body" style="width: calc(100% - 280px); margin-left: 280px; overflow-y: scroll;">
            <h2 class="pd-4 m-5">Gerir Cargas</h2>
            <div class="d-flex">
                <div class="mx-4 my-4">
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#cadastroCargaModal" style="background-color: #000; border:none;">
                        <i class="fa fa-plus-square" aria-hidden="true"></i>
                        Cadastrar Carga
                    </button>

                    <!-- Modal -->
                    <div class="modal fade" id="cadastroCargaModal" tabindex="-1" aria-labelledby="cadastroCargaModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="cadastroCargaModalLabel">Cadastro de Carga</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form method="post" action="../../controllers/Carga/criar.php" enctype="multipart/form-data">
                                        <div class="mb-3">
                                            <label for="Carga" class="form-label">Nome da Carga:</label>
                                            <input type="text" class="form-control" name="nome" placeholder="Insira o nome da Carga" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="endereco" class="form-label">Endereço:</label>
                                            <input type="text" class="form-control" name="endereco" placeholder="Insira o endereço" required>
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
                                            <label for="Logo" class="form-label">Logo:</label>
                                            <input type="file" class="form-control" name="foto" placeholder="Insira o logotipo" required>
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
                            <th>Endereço</th>
                            <th>Email</th>
                            <th>Telefone</th>
                            <th>Logo</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($Cargas as $Carga) : ?>
                            <tr style="height: 16px;">
                                <td>
                                    <span><b><?= $Carga->getIdCarga(); ?></b></span>
                                </td>
                                <td><?= $Carga->getNome(); ?></td>
                                <td><?= $Carga->getEndereco(); ?></td>
                                <td><?= $Carga->getEmail(); ?></td>
                                <td><?= $Carga->getTelefone(); ?></td>
                                <td><img src="../../../server/<?= $Carga->getCaminhoFoto(); ?>" alt="Logo" srcset="" width="50"></td>
                                <td>
                                    <a href="#" class="editButton" data-bs-toggle="modal" data-bs-target="#editModal<?= $Carga->getIdCarga(); ?>">
                                        <span style="font-size: 1.5rem; color:#000; padding-left: 16px;" aria-hidden="true">
                                            <i class="fa fa-edit"></i>
                                        </span>
                                    </a>
                                    <a href="#" data-bs-toggle="modal" data-bs-target="#deleteModal<?= $Carga->getIdCarga(); ?>">
                                        <span style="font-size: 1.5rem; color:#000; padding-left: 16px;" aria-hidden="true">
                                            <i class="fa fa-trash"></i>
                                        </span>
                                    </a>
                                </td>
                            </tr>

                            <!-- Edit Modal -->
                            <div class="modal fade" id="editModal<?= $Carga->getIdCarga(); ?>" tabindex="-1" aria-labelledby="editModalLabel<?= $Carga->getIdCarga(); ?>" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="editModalLabel<?= $Carga->getIdCarga(); ?>">Editar Carga</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="../../controllers/Carga/editar.php" method="post">
                                                <input type="hidden" name="id_Carga" value="<?= $Carga->getIdCarga(); ?>">
                                                <div class="mb-3">
                                                    <label for="nome<?= $Carga->getIdCarga(); ?>" class="form-label">Nome</label>
                                                    <input type="text" class="form-control" id="nome<?= $Carga->getIdCarga(); ?>" name="nome" value="<?= $Carga->getNome(); ?>" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="endereco<?= $Carga->getIdCarga(); ?>" class="form-label">Endereço</label>
                                                    <input type="text" class="form-control" id="endereco<?= $Carga->getIdCarga(); ?>" name="endereco" value="<?= $Carga->getEndereco(); ?>" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="email<?= $Carga->getIdCarga(); ?>" class="form-label">Email</label>
                                                    <input type="email" class="form-control" id="email<?= $Carga->getIdCarga(); ?>" name="email" value="<?= $Carga->getEmail(); ?>" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="telefone<?= $Carga->getIdCarga(); ?>" class="form-label">Telefone</label>
                                                    <input type="text" class="form-control" id="telefone<?= $Carga->getIdCarga(); ?>" name="telefone" value="<?= $Carga->getTelefone(); ?>" required>
                                                </div>
                                                <button type="submit" class="btn btn-primary">Salvar</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Delete Modal -->
                            <div class="modal fade" id="deleteModal<?= $Carga->getIdCarga(); ?>" tabindex="-1" aria-labelledby="deleteModalLabel<?= $Carga->getIdCarga(); ?>" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="deleteModalLabel<?= $Carga->getIdCarga(); ?>">Confirmar Exclusão</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            Tem certeza que deseja excluir o Carga <b><?= $Carga->getNome(); ?></b>?
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                            <form action="../../controllers/Carga/apagar.php" method="post">
                                                <input type="hidden" name="id_Carga" value="<?= $Carga->getIdCarga(); ?>">
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

    <script src="../assets/js/jquery.js"></script>
    <script src="../assets/js/bootstrap.bundle.js"></script>
</body>

</html>