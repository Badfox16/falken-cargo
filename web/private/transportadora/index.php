<?php
require_once '../../dao/TransportadoraDAO.php'; 

$TransportadoraDAO = new TransportadoraDAO();
$Transportadoras = $TransportadoraDAO->getAll();
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Falken Cargo - Transportadoras</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../../assets/css/bootstrap.css">
</head>

<body>
    <section class="d-flex">
        <?php include '../includes/sidebar.php'; ?>
        <div class="card-body" style="width: calc(100% - 280px); margin-left: 280px; overflow-y: scroll;">
            <h2 class="pd-4 m-5">Gerir Transportadoras</h2>
            <div class="d-flex">
                <div class="mx-4 my-4">
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#cadastroTransportadoraModal" style="background-color: #000; border:none;">
                        <i class="fa fa-plus-square" aria-hidden="true"></i>
                        Cadastrar Transportadora
                    </button>

                    <!-- Modal -->
                    <div class="modal fade" id="cadastroTransportadoraModal" tabindex="-1" aria-labelledby="cadastroTransportadoraModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="cadastroTransportadoraModalLabel">Cadastro de Transportadora</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form method="post" action="../../controllers/transportadora/criar.php" enctype="multipart/form-data">
                                        <div class="mb-3">
                                            <label for="Transportadora" class="form-label">Nome da Transportadora:</label>
                                            <input type="text" class="form-control" name="nome" placeholder="Insira o nome da Transportadora" required>
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
                        <?php foreach ($Transportadoras as $Transportadora) : ?>
                            <tr style="height: 16px;">
                                <td>
                                    <span><b><?= $Transportadora->getIdTransportadora(); ?></b></span>
                                </td>
                                <td><?= $Transportadora->getNome(); ?></td>
                                <td><?= $Transportadora->getEndereco(); ?></td>
                                <td><?= $Transportadora->getEmail(); ?></td>
                                <td><?= $Transportadora->getTelefone(); ?></td>
                                <td><img src="../../../server/<?= $Transportadora->getCaminhoFoto(); ?>" alt="Logo" srcset="" width="50"></td>
                                <td>
                                    <a href="#" class="editButton" data-bs-toggle="modal" data-bs-target="#editModal<?= $Transportadora->getIdTransportadora(); ?>">
                                        <span style="font-size: 1.5rem; color:#000; padding-left: 16px;" aria-hidden="true">
                                            <i class="fa fa-edit"></i>
                                        </span>
                                    </a>
                                    <a href="#" data-bs-toggle="modal" data-bs-target="#deleteModal<?= $Transportadora->getIdTransportadora(); ?>">
                                        <span style="font-size: 1.5rem; color:#000; padding-left: 16px;" aria-hidden="true">
                                            <i class="fa fa-trash"></i>
                                        </span>
                                    </a>
                                </td>
                            </tr>

                            <!-- Edit Modal -->
                            <div class="modal fade" id="editModal<?= $Transportadora->getIdTransportadora(); ?>" tabindex="-1" aria-labelledby="editModalLabel<?= $Transportadora->getIdTransportadora(); ?>" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="editModalLabel<?= $Transportadora->getIdTransportadora(); ?>">Editar Transportadora</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="../../controllers/Transportadora/editar.php" method="post">
                                                <input type="hidden" name="id_Transportadora" value="<?= $Transportadora->getIdTransportadora(); ?>">
                                                <div class="mb-3">
                                                    <label for="nome<?= $Transportadora->getIdTransportadora(); ?>" class="form-label">Nome</label>
                                                    <input type="text" class="form-control" id="nome<?= $Transportadora->getIdTransportadora(); ?>" name="nome" value="<?= $Transportadora->getNome(); ?>" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="endereco<?= $Transportadora->getIdTransportadora(); ?>" class="form-label">Endereço</label>
                                                    <input type="text" class="form-control" id="endereco<?= $Transportadora->getIdTransportadora(); ?>" name="endereco" value="<?= $Transportadora->getEndereco(); ?>" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="email<?= $Transportadora->getIdTransportadora(); ?>" class="form-label">Email</label>
                                                    <input type="email" class="form-control" id="email<?= $Transportadora->getIdTransportadora(); ?>" name="email" value="<?= $Transportadora->getEmail(); ?>" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="telefone<?= $Transportadora->getIdTransportadora(); ?>" class="form-label">Telefone</label>
                                                    <input type="text" class="form-control" id="telefone<?= $Transportadora->getIdTransportadora(); ?>" name="telefone" value="<?= $Transportadora->getTelefone(); ?>" required>
                                                </div>
                                                <button type="submit" class="btn btn-primary">Salvar</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Delete Modal -->
                            <div class="modal fade" id="deleteModal<?= $Transportadora->getIdTransportadora(); ?>" tabindex="-1" aria-labelledby="deleteModalLabel<?= $Transportadora->getIdTransportadora(); ?>" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="deleteModalLabel<?= $Transportadora->getIdTransportadora(); ?>">Confirmar Exclusão</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            Tem certeza que deseja excluir o Transportadora <b><?= $Transportadora->getNome(); ?></b>?
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                            <form action="../../controllers/Transportadora/apagar.php" method="post">
                                                <input type="hidden" name="id_Transportadora" value="<?= $Transportadora->getIdTransportadora(); ?>">
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