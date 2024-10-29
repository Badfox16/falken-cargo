<?php
require_once '../../dao/CargaDAO.php';
require_once '../../dao/UsuarioDAO.php';

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
    <link rel="stylesheet" href="../../assets/css/bootstrap.css">
</head>

<body>
    <section class="d-flex">
        <?php include '../includes/sidebar.php'; ?>
        <div class="card-body" style="width: calc(100% - 280px); margin-left: 280px; overflow-y: scroll;">
            <h2 class="pd-4 m-5">Gerir Cargas</h2>
            <div class="d-flex">
                <div class="mx-4 my-4">
                    
                </div>
            </div>
            <div class="mx-2">
                <table class="table table-responsive-lg table-hover table-bordered mb-0">
                    <thead>
                        <tr>
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
                                <td><?= $Carga->getDescricao(); ?></td>
                                <td><?= $Carga->getTipoCarga(); ?></td>
                                <td><?= $Carga->getOrigem(); ?></td>
                                <td><?= $Carga->getDestino(); ?></td>
                                <td><?= $Carga->getPrecoFrete(); ?></td>
                                <td><?= ucfirst($Carga->getEstado()); ?></td>
                                <td>
                                    <a href="#" data-bs-toggle="modal" data-bs-target="#viewModal<?= $Carga->getIdCarga(); ?>">
                                        <span style="font-size: 1.5rem; color:#000; padding-left: 16px;" aria-hidden="true">
                                            <i class="fa fa-eye"></i>
                                        </span>
                                    </a>
                                </td>
                            </tr>

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
                                            <p><strong>Estado:</strong> <?= ucfirst($Carga->getEstado()); ?></p>
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