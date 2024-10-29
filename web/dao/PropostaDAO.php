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
        $stmt = $this->pdo->prepare("INSERT INTO tbProposta (idCarga, idTransportadora, estado) VALUES (?, ?, ?, ?)");
        $stmt->execute([
            $entity->getIdCarga(),
            $entity->getIdTransportadora(),
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
            $proposta->setEstado($data['estado']);
            return $proposta;
        }

        return null;
    }

    public function update(int $id, object $entity) {
        if (!$entity instanceof Proposta) {
            throw new InvalidArgumentException('Expected instance of Proposta');
        }
        $stmt = $this->pdo->prepare("UPDATE tbProposta SET estado = ? WHERE idProposta = ?");
        $stmt->execute([
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

    public function getPropostasByUsuario(int $idUsuario) {
        $stmt = $this->pdo->prepare("
            SELECT p.*, c.tipoCarga, c.precoFrete, c.destino, c.origem, c.descricao AS cargaDescricao, t.nome AS transportadoraNome
            FROM tbProposta p
            JOIN tbCarga c ON p.idCarga = c.idCarga
            JOIN tbTransportadora t ON p.idTransportadora = t.idTransportadora
            WHERE c.idUsuario = ?
        ");
        $stmt->execute([$idUsuario]);
        $propostas = [];

        while ($data = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $proposta = new Proposta();
            $proposta->setIdProposta($data['idProposta']);
            $proposta->setIdCarga($data['idCarga']);
            $proposta->setIdTransportadora($data['idTransportadora']);
            $proposta->setEstado($data['estado']);
            $proposta->setTipoCarga($data['tipoCarga']);
            $proposta->setPrecoFrete($data['precoFrete']);
            $proposta->setDestino($data['destino']);
            $proposta->setOrigem($data['origem']);
            $proposta->setCargaDescricao($data['cargaDescricao']);
            $proposta->setTransportadoraNome($data['transportadoraNome']);
            $propostas[] = $proposta;
        }

        return $propostas;
    }
}
?>