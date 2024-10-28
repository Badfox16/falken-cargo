<?php
class Proposta {
    private $idProposta;
    private $idCarga;
    private $idTransportadora;
    private $precoOferecido;
    private $estado;
    private $dataProposta;

    public function __construct($idCarga=null, $idTransportadora=null, $precoOferecido=null, $estado = 'pendente') {
        $this->idCarga = $idCarga;
        $this->idTransportadora = $idTransportadora;
        $this->precoOferecido = $precoOferecido;
        $this->estado = $estado;
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
}
?>