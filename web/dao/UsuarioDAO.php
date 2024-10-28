<?php
require_once __DIR__ . '/../db/database.php';
require_once __DIR__ . '/../services/crud.php';
require_once __DIR__ . '/../model/usuario.php';


class UsuarioDAO implements CrudInterface {
    private $pdo;

    public function __construct() {
        $this->pdo = ConexaoBD::conectar();
    }

    public function create(object $entity) {
        if (!$entity instanceof Usuario) {
            throw new InvalidArgumentException('Expected instance of Usuario');
        }
        $stmt = $this->pdo->prepare("INSERT INTO tbUsuario (nome, apelido, email, telefone, senha) VALUES (?, ?, ?, ?, ?)");
        $stmt->execute([
            $entity->getNome(),
            $entity->getApelido(),
            $entity->getEmail(),
            $entity->getTelefone(),
            $entity->getSenha()
        ]);
    }

    public function read(int $id) {
        $stmt = $this->pdo->prepare("SELECT * FROM tbUsuario WHERE idUsuario = ?");
        $stmt->execute([$id]);

        $data = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($data) {
            $usuario = new Usuario();
            $usuario->setIdUsuario($data['idUsuario']);
            $usuario->setNome($data['nome']);
            $usuario->setApelido($data['apelido']);
            $usuario->setEmail($data['email']);
            $usuario->setTelefone($data['telefone']);
            $usuario->setSenha($data['senha']);
            return $usuario;
        }

        return null;
    }

    public function update(int $id, object $entity) {
        if (!$entity instanceof Usuario) {
            throw new InvalidArgumentException('Expected instance of Usuario');
        }
        $stmt = $this->pdo->prepare("UPDATE tbUsuario SET nome = ?, apelido = ?, email = ?, telefone = ?, senha = ? WHERE idUsuario = ?");
        $stmt->execute([
            $entity->getNome(),
            $entity->getApelido(),
            $entity->getEmail(),
            $entity->getTelefone(),
            $entity->getSenha(),
            $id
        ]);
    }

    public function delete(int $id) {
        $stmt = $this->pdo->prepare("DELETE FROM tbUsuario WHERE idUsuario = ?");
        $stmt->execute([$id]);
    }

    public function getAll() {
        $stmt = $this->pdo->prepare("SELECT * FROM tbUsuario");
        $stmt->execute();
        $usuarios = [];

        while ($data = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $usuario = new Usuario();
            $usuario->setIdUsuario($data['idUsuario']);
            $usuario->setNome($data['nome']);
            $usuario->setApelido($data['apelido']);
            $usuario->setEmail($data['email']);
            $usuario->setTelefone($data['telefone']);
            $usuario->setSenha($data['senha']);
            $usuarios[] = $usuario;
        }

        return $usuarios;
    }

    public function login(string $email, string $senha) {
        $stmt = $this->pdo->prepare("SELECT * FROM tbUsuario WHERE email = ? AND senha = ?");
        $stmt->execute([$email, $senha]);

        $data = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($data) {
            $usuario = new Usuario();
            $usuario->setIdUsuario($data['idUsuario']);
            $usuario->setNome($data['nome']);
            $usuario->setApelido($data['apelido']);
            $usuario->setEmail($data['email']);
            $usuario->setTelefone($data['telefone']);
            $usuario->setSenha($data['senha']);
            return $usuario;
        }

        return null;
    }
}
?>