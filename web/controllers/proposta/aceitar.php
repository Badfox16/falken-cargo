<?php
require_once __DIR__ . '/../../dao/PropostaDAO.php';
require_once __DIR__ . '/../../dao/CargaDAO.php';

if (isset($_GET['id']) && isset($_GET['carga'])) {
    $idProposta = intval($_GET['id']);
    $idCarga = intval($_GET['carga']);
    $PropostaDAO = new PropostaDAO();
    $CargaDAO = new CargaDAO();

    // Fetch the proposal to ensure it exists
    $proposta = $PropostaDAO->read($idProposta);

    if ($proposta) {
        // Update the proposal status to 'aceita'
        $proposta->setEstado('aceita');
        $PropostaDAO->update($idProposta, $proposta);

        // Fetch the carga to ensure it exists
        $carga = $CargaDAO->read($idCarga);

        if ($carga) {
            // Update the carga status to 'aceita'
            $carga->setEstado('aceita');
            $CargaDAO->update($idCarga, $carga);
        }

        // Redirect back to the proposals page with a success message
        header('Location: ../../public/proposta/index.php');
    } else {
        // Redirect back to the proposals page with an error message
        header('Location: ../../public/proposta/index.php');
    }
} else {
    // Redirect back to the proposals page with an error message
    header('Location: ../../public/proposta/index.php');
}
exit();
?>