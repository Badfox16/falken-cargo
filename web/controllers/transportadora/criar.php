<?php
require_once __DIR__ . '/../../dao/TransportadoraDAO.php';
require_once __DIR__ . '/../../model/transportadora.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['nome'];
    $endereco = $_POST['endereco'];
    $email = $_POST['email'];
    $telefone = $_POST['telefone'];
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

    $transportadora = new Transportadora();
    $transportadora->setNome($nome);
    $transportadora->setEndereco($endereco);
    $transportadora->setEmail($email);
    $transportadora->setTelefone($telefone);
    $transportadora->setCaminhoFoto($caminhoFoto);

    $transportadoraDAO = new TransportadoraDAO();
    $transportadoraDAO->create($transportadora);

    header('Location: ../../views/transportadora/index.php');
    exit();
}
?>