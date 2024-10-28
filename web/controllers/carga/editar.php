<?php
require_once '../../../dao/CargaDAO.php';
require_once '../../../model/Carga.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $idCarga = $_POST['id_Carga'];
    $descricao = $_POST['descricao'];
    $tipoCarga = $_POST['tipoCarga'];
    $origem = $_POST['origem'];
    $destino = $_POST['destino'];
    $precoFrete = $_POST['precoFrete'];

    $CargaDAO = new CargaDAO();
    $carga = $CargaDAO->read($idCarga);

    if ($carga) {
        $carga->setDescricao($descricao);
        $carga->setTipoCarga($tipoCarga);
        $carga->setOrigem($origem);
        $carga->setDestino($destino);
        $carga->setPrecoFrete($precoFrete);

        $CargaDAO->update($idCarga, $carga);

        header('Location: ../../public/carga/');
        exit();
    } else {
        echo "Carga não encontrada.";
    }
} else {
    echo "Método de requisição inválido.";
}
?>