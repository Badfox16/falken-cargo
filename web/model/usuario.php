<?php
class Usuario {
    private $idUsuario;
    private $nome;
    private $apelido;
    private $email;
    private $telefone;
    private $senha;

    public function __construct($nome = null, $email = null, $senha = null, $apelido = null, $telefone = null) {
        $this->nome = $nome;
        $this->email = $email;
        $this->senha = $senha;
        $this->apelido = $apelido;
        $this->telefone = $telefone;
    }

    public function getIdUsuario() {
        return $this->idUsuario;
    }

    public function getNome() {
        return $this->nome;
    }

    public function getApelido() {
        return $this->apelido;
    }

    public function getEmail() {
        return $this->email;
    }

    public function getTelefone() {
        return $this->telefone;
    }

    public function getSenha() {
        return $this->senha;
    }

    public function setNome($nome) {
        $this->nome = $nome;
    }

    public function setApelido($apelido) {
        $this->apelido = $apelido;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function setTelefone($telefone) {
        $this->telefone = $telefone;
    }

    public function setSenha($senha) {
        $this->senha = $senha;
    }

    public function setIdUsuario($idUsuario) {
        $this->idUsuario = $idUsuario;
    }
}
?>