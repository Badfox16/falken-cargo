<?php
class Transportadora {
    private $idTransportadora;
    private $nome;
    private $email;
    private $telefone;
    private $caminhoFoto;
    private $endereco;

    public function __construct($nome=null, $email=null, $telefone=null, $caminhoFoto=null, $endereco=null) {
        $this->nome = $nome;
        $this->email = $email;
        $this->telefone = $telefone;
        $this->caminhoFoto = $caminhoFoto;
        $this->endereco = $endereco;
    }

    public function getIdTransportadora() {
        return $this->idTransportadora;
    }

    public function getNome() {
        return $this->nome;
    }

    public function getEmail() {
        return $this->email;
    }

    public function getTelefone() {
        return $this->telefone;
    }

    public function getCaminhoFoto() {
        return $this->caminhoFoto;
    }

    public function getEndereco() {
        return $this->endereco;
    }

    public function setNome($nome) {
        $this->nome = $nome;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function setTelefone($telefone) {
        $this->telefone = $telefone;
    }

    public function setCaminhoFoto($caminhoFoto) {
        $this->caminhoFoto = $caminhoFoto;
    }

    public function setEndereco($endereco) {
        $this->endereco = $endereco;
    }

    public function setIdTransportadora($idTransportadora) {
        $this->idTransportadora = $idTransportadora;
    }
}
?>