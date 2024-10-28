<?php

require_once __DIR__ . '/../db/database.php';
require_once __DIR__ . '/../services/crud.php';
require_once __DIR__ . '/../model/carga.php';

class CargaDAO implements CrudInterface {

    private $pdo;

    public function __construct() {
        $this->pdo = ConexaoBD::conectar();
    }

    public function create(object $entity) {
        if (!$entity instanceof Carga) {
            throw new InvalidArgumentException('Expected instance of Carga');
        }
        $sql = "INSERT INTO tbCarga (idUsuario, descricao, tipoCarga, origem, destino, precoFrete, estado, caminhoFoto) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            $entity->getIdUsuario(),
            $entity->getDescricao(),
            $entity->getTipoCarga(),
            $entity->getOrigem(),
            $entity->getDestino(),
            $entity->getPrecoFrete(),
            $entity->getEstado(),
            $entity->getCaminhoFoto()
        ]);
    }

    public function read(int $id) {
        $sql = "SELECT * FROM tbCarga WHERE idCarga = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$id]);

        $data = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($data) {
            $carga = new Carga();
            $carga->setIdCarga($data['idCarga']);
            $carga->setIdUsuario($data['idUsuario']);
            $carga->setDescricao($data['descricao']);
            $carga->setTipoCarga($data['tipoCarga']);
            $carga->setOrigem($data['origem']);
            $carga->setDestino($data['destino']);
            $carga->setPrecoFrete($data['precoFrete']);
            $carga->setEstado($data['estado']);
            $carga->setCaminhoFoto($data['caminhoFoto']);
            return $carga;
        }

        return null;
    }

    public function update(int $id, object $entity) {
        if (!$entity instanceof Carga) {
            throw new InvalidArgumentException('Expected instance of Carga');
        }
        $sql = "UPDATE tbCarga SET 
                idUsuario = ?, 
                descricao = ?, 
                tipoCarga = ?, 
                origem = ?, 
                destino = ?, 
                precoFrete = ?, 
                estado = ?, 
                caminhoFoto = ? 
                WHERE idCarga = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            $entity->getIdUsuario(),
            $entity->getDescricao(),
            $entity->getTipoCarga(),
            $entity->getOrigem(),
            $entity->getDestino(),
            $entity->getPrecoFrete(),
            $entity->getEstado(),
            $entity->getCaminhoFoto(),
            $id
        ]);
    }

    public function delete(int $id) {
        $sql = "DELETE FROM tbCarga WHERE idCarga = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$id]);
    }

    public function getAll() {
        $sql = "SELECT * FROM tbCarga";
        $stmt = $this->pdo->query($sql);
        $cargas = [];

        while ($data = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $carga = new Carga();
            $carga->setIdCarga($data['idCarga']);
            $carga->setIdUsuario($data['idUsuario']);
            $carga->setDescricao($data['descricao']);
            $carga->setTipoCarga($data['tipoCarga']);
            $carga->setOrigem($data['origem']);
            $carga->setDestino($data['destino']);
            $carga->setPrecoFrete($data['precoFrete']);
            $carga->setEstado($data['estado']);
            $carga->setCaminhoFoto($data['caminhoFoto']);
            $cargas[] = $carga;
        }

        return $cargas;
    }

    public function getByUserId(int $userId) {
        $sql = "SELECT * FROM tbCarga WHERE idUsuario = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$userId]);
        $cargas = [];

        while ($data = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $carga = new Carga();
            $carga->setIdCarga($data['idCarga']);
            $carga->setIdUsuario($data['idUsuario']);
            $carga->setDescricao($data['descricao']);
            $carga->setTipoCarga($data['tipoCarga']);
            $carga->setOrigem($data['origem']);
            $carga->setDestino($data['destino']);
            $carga->setPrecoFrete($data['precoFrete']);
            $carga->setEstado($data['estado']);
            $carga->setCaminhoFoto($data['caminhoFoto']);
            $cargas[] = $carga;
        }

        return $cargas;
    }
}
?>
