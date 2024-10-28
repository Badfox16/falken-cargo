<?php
require_once __DIR__ . '/../../dao/UsuarioDAO.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $idUsuario = filter_input(INPUT_POST, 'id_usuario', FILTER_VALIDATE_INT);

    if ($idUsuario) {
        $usuarioDAO = new UsuarioDAO();
        $usuarioDAO->delete($idUsuario);
    }
}

header('Location: ../../views/usuario/');
exit;
