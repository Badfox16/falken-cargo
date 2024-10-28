<?php
require_once '../../dao/CargaDAO.php';
require_once '../../dao/UsuarioDAO.php';

session_start();

if (isset($_SESSION['usuario'])) {
    $idUsuario = $_SESSION['usuario']->getIdUsuario();
} else {
    // Redirecionar para a página de login se o usuário não estiver logado
    header('Location: ../login/');
    exit();
}

$CargaDAO = new CargaDAO();
$Cargas = $CargaDAO->getByUserId($idUsuario);
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Falken Cargo - Cargas</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../../assets/css/bootstrap.css">
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
                                    <form method="post" action="../../controllers/carga/criar.php" enctype="multipart/form-data">
                                        <div class="mb-3">
                                            <label for="descricao" class="form-label">Descrição da Carga:</label>
                                            <textarea class="form-control" name="descricao" placeholder="Insira a descrição da carga" required></textarea>
                                        </div>
                                        <div class="mb-3">
                                            <label for="tipoCarga" class="form-label">Tipo de Carga:</label>
                                            <select class="form-control" name="tipoCarga" required>
                                                <option value="" disabled selected>Selecione o tipo de carga</option>
                                                <option value="Perigosa">Perigosa</option>
                                                <option value="Frágil">Frágil</option>
                                                <option value="Comum">Comum</option>
                                                <option value="Contentor">Contentor</option>
                                                <option value="Refrigerada">Refrigerada</option>
                                                <option value="Outro">Outro</option>
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label for="origem" class="form-label">Origem:</label>
                                            <input type="text" class="form-control" name="origem" placeholder="Insira a origem" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="destino" class="form-label">Destino:</label>
                                            <input type="text" class="form-control" name="destino" placeholder="Insira o destino" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="precoFrete" class="form-label">Preço do Frete:</label>
                                            <input type="text" class="form-control" name="precoFrete" placeholder="Insira o preço do frete" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="foto" class="form-label">Foto:</label>
                                            <input type="file" class="form-control" name="foto" placeholder="Insira a foto" required>
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
                            <th>Descrição</th>
                            <th>Tipo de Carga</th>
                            <th>Origem</th>
                            <th>Destino</th>
                            <th>Preço do Frete</th>
                            <th>Estado</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($Cargas as $Carga) : ?>
                            <tr style="height: 16px;">
                                <td>
                                    <span><b><?= $Carga->getIdCarga(); ?></b></span>
                                </td>
                                <td><?= $Carga->getDescricao(); ?></td>
                                <td><?= $Carga->getTipoCarga(); ?></td>
                                <td><?= $Carga->getOrigem(); ?></td>
                                <td><?= $Carga->getDestino(); ?></td>
                                <td><?= $Carga->getPrecoFrete(); ?></td>
                                <td><?= $Carga->getEstado(); ?></td>
                                <td>
                                    <a href="#" class="editButton" data-bs-toggle="modal" data-bs-target="#editModal<?= $Carga->getIdCarga(); ?>">
                                        <span style="font-size: 1.5rem; color:#000; padding-left: 16px;" aria-hidden="true">
                                            <i class="fa fa-edit"></i>
                                        </span>
                                    </a>
                                    <a href="#" data-bs-toggle="modal" data-bs-target="#viewModal<?= $Carga->getIdCarga(); ?>">
                                        <span style="font-size: 1.5rem; color:#000; padding-left: 16px;" aria-hidden="true">
                                            <i class="fa fa-eye"></i>
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
                                            <form action="../../controllers/carga/editar.php" method="post">
                                                <input type="hidden" name="id_Carga" value="<?= $Carga->getIdCarga(); ?>">
                                                <div class="mb-3">
                                                    <label for="descricao<?= $Carga->getIdCarga(); ?>" class="form-label">Descrição</label>
                                                    <input type="text" class="form-control" id="descricao<?= $Carga->getIdCarga(); ?>" name="descricao" value="<?= $Carga->getDescricao(); ?>" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="tipoCarga<?= $Carga->getIdCarga(); ?>" class="form-label">Tipo de Carga</label>
                                                    <select class="form-control" id="tipoCarga<?= $Carga->getIdCarga(); ?>" name="tipoCarga" required>
                                                        <option value="Perigosa" <?= $Carga->getTipoCarga() == 'Perigosa' ? 'selected' : ''; ?>>Perigosa</option>
                                                        <option value="Frágil" <?= $Carga->getTipoCarga() == 'Frágil' ? 'selected' : ''; ?>>Frágil</option>
                                                        <option value="Comum" <?= $Carga->getTipoCarga() == 'Comum' ? 'selected' : ''; ?>>Comum</option>
                                                        <option value="Contentor" <?= $Carga->getTipoCarga() == 'Contentor' ? 'selected' : ''; ?>>Contentor</option>
                                                        <option value="Refrigerada" <?= $Carga->getTipoCarga() == 'Refrigerada' ? 'selected' : ''; ?>>Refrigerada</option>
                                                        <option value="Outro" <?= $Carga->getTipoCarga() == 'Outro' ? 'selected' : ''; ?>>Outro</option>
                                                    </select>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="origem<?= $Carga->getIdCarga(); ?>" class="form-label">Origem</label>
                                                    <input type="text" class="form-control" id="origem<?= $Carga->getIdCarga(); ?>" name="origem" value="<?= $Carga->getOrigem(); ?>" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="destino<?= $Carga->getIdCarga(); ?>" class="form-label">Destino</label>
                                                    <input type="text" class="form-control" id="destino<?= $Carga->getIdCarga(); ?>" name="destino" value="<?= $Carga->getDestino(); ?>" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="precoFrete<?= $Carga->getIdCarga(); ?>" class="form-label">Preço do Frete</label>
                                                    <input type="text" class="form-control" id="precoFrete<?= $Carga->getIdCarga(); ?>" name="precoFrete" value="<?= $Carga->getPrecoFrete(); ?>" required>
                                                </div>
                                                <button type="submit" class="btn btn-primary">Salvar</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- View Modal -->
                            <div class="modal fade" id="viewModal<?= $Carga->getIdCarga(); ?>" tabindex="-1" aria-labelledby="viewModalLabel<?= $Carga->getIdCarga(); ?>" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="viewModalLabel<?= $Carga->getIdCarga(); ?>">Detalhes da Carga</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <p><strong>ID:</strong> <?= $Carga->getIdCarga(); ?></p>
                                            <p><strong>Descrição:</strong> <?= $Carga->getDescricao(); ?></p>
                                            <p><strong>Tipo de Carga:</strong> <?= $Carga->getTipoCarga(); ?></p>
                                            <p><strong>Origem:</strong> <?= $Carga->getOrigem(); ?></p>
                                            <p><strong>Destino:</strong> <?= $Carga->getDestino(); ?></p>
                                            <p><strong>Preço do Frete:</strong> <?= $Carga->getPrecoFrete(); ?></p>
                                            <p><strong>Estado:</strong> <?= $Carga->getEstado(); ?></p>
                                            <p><strong>Foto:</strong></p>
                                            <img src="../../../server/<?= $Carga->getCaminhoFoto(); ?>" alt="Foto da Carga" class="img-fluid">
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
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