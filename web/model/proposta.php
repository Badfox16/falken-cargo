<?php
class Proposta {
    private $idProposta;
    private $idCarga;
    private $idTransportadora;
    private $precoOferecido;
    private $estado;
    private $tipoCarga;
    private $precoFrete;
    private $destino;
    private $origem;
    private $cargaDescricao;
    private $transportadoraNome;
    private $dataProposta;

    public function __construct($idProposta=null, $idCarga=null, $idTransportadora=null, $precoOferecido=null, $estado='pendente', $tipoCarga=null, $precoFrete=null, $destino=null, $origem=null, $cargaDescricao=null, $transportadoraNome=null, $dataProposta=null) {
        $this->idProposta = $idProposta;
        $this->idCarga = $idCarga;
        $this->idTransportadora = $idTransportadora;
        $this->precoOferecido = $precoOferecido;
        $this->estado = $estado;
        $this->tipoCarga = $tipoCarga;
        $this->precoFrete = $precoFrete;
        $this->destino = $destino;
        $this->origem = $origem;
        $this->cargaDescricao = $cargaDescricao;
        $this->transportadoraNome = $transportadoraNome;
        $this->dataProposta = $dataProposta;
    }

    public function getIdProposta() {
        return $this->idProposta;
    }

    public function getIdCarga() {
        return $this->idCarga;
    }

    public function getIdTransportadora() {
        return $this->idTransportadora;
    }

    public function getPrecoOferecido() {
        return $this->precoOferecido;
    }

    public function getEstado() {
        return $this->estado;
    }

    public function getDataProposta() {
        return $this->dataProposta;
    }

    public function setIdCarga($idCarga) {
        $this->idCarga = $idCarga;
    }

    public function setIdTransportadora($idTransportadora) {
        $this->idTransportadora = $idTransportadora;
    }

    public function setPrecoOferecido($precoOferecido) {
        $this->precoOferecido = $precoOferecido;
    }

    public function setEstado($estado) {
        $this->estado = $estado;
    }
    
    public function getTipoCarga() {
        return $this->tipoCarga;
    }

    public function setTipoCarga($tipoCarga) {
        $this->tipoCarga = $tipoCarga;
    }

    public function getPrecoFrete() {
        return $this->precoFrete;
    }

    public function setPrecoFrete($precoFrete) {
        $this->precoFrete = $precoFrete;
    }

    public function getDestino() {
        return $this->destino;
    }

    public function setDestino($destino) {
        $this->destino = $destino;
    }

    public function getOrigem() {
        return $this->origem;
    }

    public function setOrigem($origem) {
        $this->origem = $origem;
    }

    public function getCargaDescricao() {
        return $this->cargaDescricao;
    }

    public function setCargaDescricao($cargaDescricao) {
        $this->cargaDescricao = $cargaDescricao;
    }

    public function getTransportadoraNome() {
        return $this->transportadoraNome;
    }

    public function setTransportadoraNome($transportadoraNome) {
        $this->transportadoraNome = $transportadoraNome;
    }

    /**
     * Set the value of idProposta
     *
     * @return  self
     */ 
    public function setIdProposta($idProposta)
    {
        $this->idProposta = $idProposta;

        return $this;
    }
}
?>