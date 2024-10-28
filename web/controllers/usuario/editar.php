<?php
require_once '../../dao/UsuarioDAO.php'; 
require_once '../../model/usuario.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $idUsuario = $_POST['id_usuario'];
    $nome = $_POST['nome'];
    $apelido = $_POST['apelido'];
    $email = $_POST['email'];
    $telefone = $_POST['telefone'];

    $usuarioDAO = new UsuarioDAO();
    $usuario = $usuarioDAO->read($idUsuario);

    if ($usuario) {
        $usuario->setNome($nome);
        $usuario->setApelido($apelido);
        $usuario->setEmail($email);
        $usuario->setTelefone($telefone);

        $usuarioDAO->update($idUsuario, $usuario);
    }

    header('Location: ../../public/usuario/'); 
    exit();
}
?>