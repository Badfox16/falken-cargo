<?php
class Carga {
    private $idCarga;
    private $idUsuario;
    private $descricao;
    private $tipoCarga;
    private $origem;
    private $destino;
    private $precoFrete;
    private $estado;
    private $caminhoFoto;

    public function __construct($idCarga = null, $idUsuario = null, $descricao = null, $tipoCarga = null, $origem = null, $destino = null, $precoFrete = null, $estado = 'pendente', $caminhoFoto=null) {
        $this->idCarga = $idCarga;
        $this->idUsuario = $idUsuario;
        $this->descricao = $descricao;
        $this->tipoCarga = $tipoCarga;
        $this->origem = $origem;
        $this->destino = $destino;
        $this->precoFrete = $precoFrete;
        $this->estado = $estado;
        $this->caminhoFoto = $caminhoFoto;
    }

    // Getters and Setters
    public function getIdCarga() {
        return $this->idCarga;
    }

    public function setIdCarga($idCarga) {
        $this->idCarga = $idCarga;
    }

    public function getIdUsuario() {
        return $this->idUsuario;
    }

    public function setIdUsuario($idUsuario) {
        $this->idUsuario = $idUsuario;
    }

    public function getDescricao() {
        return $this->descricao;
    }

    public function setDescricao($descricao) {
        $this->descricao = $descricao;
    }

    public function getTipoCarga() {
        return $this->tipoCarga;
    }

    public function setTipoCarga($tipoCarga) {
        $this->tipoCarga = $tipoCarga;
    }

    public function getOrigem() {
        return $this->origem;
    }

    public function setOrigem($origem) {
        $this->origem = $origem;
    }

    public function getDestino() {
        return $this->destino;
    }

    public function setDestino($destino) {
        $this->destino = $destino;
    }

    public function getPrecoFrete() {
        return $this->precoFrete;
    }

    public function setPrecoFrete($precoFrete) {
        $this->precoFrete = $precoFrete;
    }

    public function getEstado() {
        return $this->estado;
    }

    public function setEstado($estado) {
        $this->estado = $estado;
    }

    public function getCaminhoFoto() {
        return $this->caminhoFoto;
    }

    public function setCaminhoFoto($caminhoFoto) {
        $this->caminhoFoto = $caminhoFoto;
    }
}
?>