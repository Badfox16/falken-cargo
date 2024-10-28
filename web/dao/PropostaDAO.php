<?php
require_once __DIR__ . '/../db/database.php';
require_once __DIR__ . '/../services/crud.php';
require_once __DIR__ . '/../model/proposta.php';

class PropostaDAO implements CrudInterface {
    private $pdo;

    public function __construct() {
        $this->pdo = ConexaoBD::conectar();
    }

    public function create(object $entity) {
        if (!$entity instanceof Proposta) {
            throw new InvalidArgumentException('Expected instance of Proposta');
        }
        $stmt = $this->pdo->prepare("INSERT INTO tbProposta (idCarga, idTransportadora, precoOferecido, estado) VALUES (?, ?, ?, ?)");
        $stmt->execute([
            $entity->getIdCarga(),
            $entity->getIdTransportadora(),
            $entity->getPrecoOferecido(),
            $entity->getEstado()
        ]);
    }

    public function read(int $id) {
        $stmt = $this->pdo->prepare("SELECT * FROM tbProposta WHERE idProposta = ?");
        $stmt->execute([$id]);

        $data = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($data) {
            $proposta = new Proposta();
            $proposta->setIdCarga($data['idCarga']);
            $proposta->setIdTransportadora($data['idTransportadora']);
            $proposta->setPrecoOferecido($data['precoOferecido']);
            $proposta->setEstado($data['estado']);
            return $proposta;
        }

        return null;
    }

    public function update(int $id, object $entity) {
        if (!$entity instanceof Proposta) {
            throw new InvalidArgumentException('Expected instance of Proposta');
        }
        $stmt = $this->pdo->prepare("UPDATE tbProposta SET idCarga = ?, idTransportadora = ?, precoOferecido = ?, estado = ? WHERE idProposta = ?");
        $stmt->execute([
            $entity->getIdCarga(),
            $entity->getIdTransportadora(),
            $entity->getPrecoOferecido(),
            $entity->getEstado(),
            $id
        ]);
    }

    public function delete(int $id) {
        $stmt = $this->pdo->prepare("DELETE FROM tbProposta WHERE idProposta = ?");
        $stmt->execute([$id]);
    }

    public function getAll() {
        $stmt = $this->pdo->prepare("SELECT * FROM tbProposta");
        $stmt->execute();
        $propostas = [];

        while ($data = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $proposta = new Proposta();
            $proposta->setIdCarga($data['idCarga']);
            $proposta->setIdTransportadora($data['idTransportadora']);
            $proposta->setPrecoOferecido($data['precoOferecido']);
            $proposta->setEstado($data['estado']);
            $propostas[] = $proposta;
        }

        return $propostas;
    }
}
?>