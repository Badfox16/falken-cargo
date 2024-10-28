<?php
require_once '../../dao/UsuarioDAO.php'; 
require_once '../../model/usuario.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usuario = new Usuario( );
    $usuario->setNome($_POST['nome']);
    $usuario->setEmail($_POST['email']);
    $usuario->setApelido($_POST['apelido']);
    $usuario->setTelefone($_POST['telefone']);
    $usuario->setSenha($_POST['senha']);

    $usuarioDAO = new UsuarioDAO();
    $usuarioDAO->create($usuario);

    header('Location: ../../views/usuario/'); 
    exit();
}
?>
