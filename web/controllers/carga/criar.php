<?php
require_once __DIR__ . '/../../dao/CargaDAO.php';
require_once __DIR__ . '/../../dao/UsuarioDAO.php';
require_once __DIR__ . '/../../model/carga.php';

session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $idUsuario = $_SESSION['usuario']->getIdUsuario();
    $descricao = $_POST['descricao'];
    $tipoCarga = $_POST['tipoCarga'];
    $origem = $_POST['origem'];
    $destino = $_POST['destino'];
    $precoFrete = $_POST['precoFrete'];
    $foto = $_FILES['foto'];

    // Handle file upload
    $uploadDir = __DIR__ . '/../../../server/uploads/';
    $uniqueName = uniqid() . '.' . pathinfo($foto['name'], PATHINFO_EXTENSION);
    $uploadFile = $uploadDir . $uniqueName;
    if (move_uploaded_file($foto['tmp_name'], $uploadFile)) {
        $caminhoFoto = '/uploads/' . $uniqueName;
    } else {
        // Handle file upload error
        die('Erro ao fazer upload do arquivo.');
    }

    $carga = new Carga();
    $carga->setIdUsuario($idUsuario);
    $carga->setDescricao($descricao);
    $carga->setTipoCarga($tipoCarga);
    $carga->setOrigem($origem);
    $carga->setDestino($destino);
    $carga->setPrecoFrete($precoFrete);
    $carga->setCaminhoFoto($caminhoFoto);
    $carga->setEstado('Pendente'); // Definindo um estado padrão

    $cargaDAO = new CargaDAO();
    $cargaDAO->create($carga);

    header('Location: ../../public/carga/');
    exit();
}
?>