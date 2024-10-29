<?php
require_once '../../dao/PropostaDAO.php';
require_once '../../dao/UsuarioDAO.php';

session_start();

if (isset($_SESSION['usuario'])) {
    $idUsuario = $_SESSION['usuario']->getIdUsuario();
} else {
    // Redirecionar para a página de login se o usuário não estiver logado
    header('Location: ../login/');
    exit();
}

$PropostaDAO = new PropostaDAO();
$Propostas = $PropostaDAO->getPropostasByUsuario($idUsuario);
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Falken Cargo - Propostas</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../../assets/css/bootstrap.css">
</head>

<body>
    <section class="d-flex">
        <?php include '../includes/sidebar.php'; ?>
        <div class="card-body" style="width: calc(100% - 280px); margin-left: 280px; overflow-y: scroll;">
            <h2 class="pd-4 m-5">Gerir Propostas</h2>
            <div class="d-flex">
                <div class="mx-4 my-4">
                    
                </div>
            </div>
            <div class="mx-2">
            <table class="table table-responsive-lg table-hover table-bordered mb-0">
                    <thead>
                        <tr>
                            <th>ID Carga</th>
                            <th>Tipo de Carga</th>
                            <th>Origem</th>
                            <th>Destino</th>
                            <th>Transportadora</th>
                            <th>Preço Oferecido</th>
                            <th>Estado</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($Propostas as $proposta) : ?>
                            <tr style="height: 16px;">
                                <td><?= $proposta->getIdCarga(); ?></td>
                                <td><?= $proposta->getTipoCarga(); ?></td>
                                <td><?= $proposta->getOrigem(); ?></td>
                                <td><?= $proposta->getDestino(); ?></td>
                                <td><?= $proposta->getTransportadoraNome(); ?></td>
                                <td><?= $proposta->getPrecoFrete(); ?></td>
                                <td><?= ucfirst($proposta->getEstado()); ?></td>
                                <td>
                                    <a href="#" data-bs-toggle="modal" data-bs-target="#viewModal<?= $proposta->getIdProposta(); ?>">
                                        <span style="font-size: 1.5rem; color:#000; padding-left: 16px;" aria-hidden="true">
                                            <i class="fa fa-eye"></i>
                                        </span>
                                    </a>
                                    <a href="#" data-bs-toggle="modal" data-bs-target="#actionModal<?= $proposta->getIdProposta(); ?>">
                                        <span style="font-size: 1.5rem; color:#000; padding-left: 16px;" aria-hidden="true">
                                            <i class="fa fa-check"></i>
                                        </span>
                                    </a>
                                </td>

                                <!-- Action Modal -->
                                <div class="modal fade" id="actionModal<?= $proposta->getIdProposta(); ?>" tabindex="-1" aria-labelledby="actionModalLabel<?= $proposta->getIdProposta(); ?>" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="actionModalLabel<?= $proposta->getIdProposta(); ?>">Aceitar ou Recusar Proposta</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <p>Você deseja aceitar ou recusar esta proposta?</p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                                                <a href="../../controllers/proposta/aceitar.php?id=<?= $proposta->getIdProposta(); ?>" class="btn btn-success">Aceitar</a>
                                                <a href="../../controllers/proposta/recusar.php?id=<?= $proposta->getIdProposta(); ?>" class="btn btn-danger">Recusar</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </tr>

                            <!-- View Modal -->
                            <div class="modal fade" id="viewModal<?= $proposta->getIdProposta(); ?>" tabindex="-1" aria-labelledby="viewModalLabel<?= $proposta->getIdProposta(); ?>" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="viewModalLabel<?= $proposta->getIdProposta(); ?>">Detalhes da Proposta</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <p><strong>ID Proposta:</strong> <?= $proposta->getIdProposta(); ?></p>
                                            <p><strong>ID Carga:</strong> <?= $proposta->getIdCarga(); ?></p>
                                            <p><strong>Tipo de Carga:</strong> <?= $proposta->getTipoCarga(); ?></p>
                                            <p><strong>Origem:</strong> <?= $proposta->getOrigem(); ?></p>
                                            <p><strong>Destino:</strong> <?= $proposta->getDestino(); ?></p>
                                            <p><strong>Transportadora:</strong> <?= $proposta->getTransportadoraNome(); ?></p>
                                            <p><strong>Preço Oferecido:</strong> <?= $proposta->getPrecoOferecido(); ?></p>
                                            <p><strong>Estado:</strong> <?= ucfirst($proposta->getEstado()); ?></p>
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
