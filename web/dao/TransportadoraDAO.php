<?php

require_once __DIR__ . '/../db/database.php';
require_once __DIR__ . '/../services/crud.php';
require_once __DIR__ . '/../model/transportadora.php';

class TransportadoraDAO implements CrudInterface {

    private $pdo;

    public function __construct() {
        $this->pdo = ConexaoBD::conectar();
    }

    public function create(object $entity) {
        if (!$entity instanceof Transportadora) {
            throw new InvalidArgumentException('Expected instance of Transportadora');
        }
        $stmt = $this->pdo->prepare("INSERT INTO tbTransportadora (nome, email, telefone, caminhoFoto, endereco) VALUES (?, ?, ?, ?, ?)");
        $stmt->execute([
            $entity->getNome(),
            $entity->getEmail(),
            $entity->getTelefone(),
            $entity->getCaminhoFoto(),
            $entity->getEndereco()
        ]);
    }

    public function read(int $id) {
        $sql = "SELECT * FROM tbTransportadora WHERE idTransportadora = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$id]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($result) {
            $transportadora = new Transportadora();
            $transportadora->setIdTransportadora($result['idTransportadora']);
            $transportadora->setNome($result['nome']);
            $transportadora->setEmail($result['email']);
            $transportadora->setTelefone($result['telefone']);
            $transportadora->setCaminhoFoto($result['caminhoFoto']);
            $transportadora->setEndereco($result['endereco']);
            return $transportadora;
        }
        return null;
    }

    public function update(int $id, object $entity) {
        if (!$entity instanceof Transportadora) {
            throw new InvalidArgumentException('Expected instance of Transportadora');
        }

        $sql = "UPDATE tbTransportadora SET nome = ?, email = ?, telefone = ?, caminhoFoto = ?, endereco = ? WHERE idTransportadora = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            $entity->getNome(),
            $entity->getEmail(),
            $entity->getTelefone(),
            $entity->getCaminhoFoto(),
            $entity->getEndereco(),
            $id
        ]);
    }

    public function delete(int $id) {
        $sql = "DELETE FROM tbTransportadora WHERE idTransportadora = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$id]);
    }

    public function getAll() {
        $sql = "SELECT * FROM tbTransportadora";
        $stmt = $this->pdo->query($sql);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $transportadoras = [];
        foreach ($result as $row) {
            $transportadora = new Transportadora();
            $transportadora->setIdTransportadora($row['idTransportadora']);
            $transportadora->setNome($row['nome']);
            $transportadora->setEmail($row['email']);
            $transportadora->setTelefone($row['telefone']);
            $transportadora->setCaminhoFoto($row['caminhoFoto']);
            $transportadora->setEndereco($row['endereco']);
            $transportadoras[] = $transportadora;
        }
        return $transportadoras;
    }
}
?>
