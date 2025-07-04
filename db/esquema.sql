-- Base de datos para Huellitas Perdidas
CREATE DATABASE IF NOT EXISTS HuellitasPerdidas DEFAULT CHARACTER SET utf8mb4;
USE HuellitasPerdidas;

CREATE TABLE usuarios (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nombre VARCHAR(100) NOT NULL,
  email VARCHAR(100) NOT NULL UNIQUE,
  telefono VARCHAR(20) NOT NULL,
  nacimiento DATE NOT NULL,
  password VARCHAR(255) NOT NULL
);

CREATE TABLE mascota (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nombredemascota VARCHAR(100) DEFAULT '',
  especie VARCHAR(50) DEFAULT '',
  raza VARCHAR(50) DEFAULT '',
  descripcion TEXT,
  ubicacion VARCHAR(255) DEFAULT '',
  fechadeextravio DATE,
  foto TEXT,
  id_usuario INT,
  FOREIGN KEY (id_usuario) REFERENCES usuarios(id)
);
