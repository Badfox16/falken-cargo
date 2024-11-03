CREATE DATABASE bdfalkencargo
CHARACTER SET utf8mb4
COLLATE utf8mb4_unicode_ci;

USE bdfalkencargo;

CREATE TABLE tbUsuario (
    idUsuario INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    apelido VARCHAR(50),
    email VARCHAR(100) UNIQUE NOT NULL,
    telefone VARCHAR(20),
    senha VARCHAR(255) NOT NULL
);

CREATE TABLE tbCarga (
    idCarga INT AUTO_INCREMENT PRIMARY KEY,
    idUsuario INT NOT NULL,
    descricao TEXT NOT NULL,
    tipoCarga VARCHAR(50),
    origem VARCHAR(100) NOT NULL,
    destino VARCHAR(100) NOT NULL,
    precoFrete DECIMAL(10, 2) NOT NULL,
    estado ENUM('pendente', 'aceita', 'completa') DEFAULT 'pendente',
    caminhoFoto VARCHAR(255),
    FOREIGN KEY (idUsuario) REFERENCES tbUsuario(idUsuario)
);

CREATE TABLE tbTransportadora (
    idTransportadora INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    telefone VARCHAR(20),
    caminhoFoto VARCHAR(255),
    endereco VARCHAR(255),
    senha VARCHAR(255)
);

CREATE TABLE tbProposta (
    idProposta INT AUTO_INCREMENT PRIMARY KEY,
    idCarga INT NOT NULL,
    idTransportadora INT NOT NULL,
    estado ENUM('pendente', 'aceita', 'rejeitada') DEFAULT 'pendente',
    dataProposta TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (idCarga) REFERENCES tbCarga(idCarga),
    FOREIGN KEY (idTransportadora) REFERENCES tbTransportadora(idTransportadora)
);
