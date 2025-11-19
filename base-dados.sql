CREATE DATABASE IF NOT EXISTS aircontrol;
USE aircontrol;

-- Tabela de utilizadores (para login futuro)
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    email VARCHAR(120) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    criado_em TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Tabela de pedidos
CREATE TABLE pedidos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    codigo VARCHAR(50) NOT NULL,
    data_pedido DATE NOT NULL,
    tipo_pedido VARCHAR(50) NOT NULL,
    intervencao VARCHAR(100),
    tecnico VARCHAR(100),
    estado VARCHAR(50),
    observacoes TEXT,
    criado_em TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Tabela de avaliações (para "cliente-avaliacao")
CREATE TABLE avaliacao_membros (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100),
    score VARCHAR(10),
    subtitle VARCHAR(255)
);

CREATE TABLE avaliacao_tarefas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    membro_id INT,
    label VARCHAR(100),
    percent VARCHAR(10),
    valor INT,
    FOREIGN KEY (membro_id) REFERENCES avaliacao_membros(id) ON DELETE CASCADE
);
