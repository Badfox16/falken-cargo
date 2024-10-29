<?php
require_once __DIR__ . '/../../dao/PropostaDAO.php';

if (isset($_GET['id'])) {
    $idProposta = intval($_GET['id']);
    $PropostaDAO = new PropostaDAO();

    // Fetch the proposal to ensure it exists
    $proposta = $PropostaDAO->read($idProposta);

    if ($proposta) {
        // Update the proposal status to 'aceita'
        $proposta->setEstado('aceita');
        // var_dump($proposta);
        $PropostaDAO->update($idProposta, $proposta);

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