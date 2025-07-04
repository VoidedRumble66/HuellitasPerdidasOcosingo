-- Base de datos para Huellitas Perdidas
CREATE DATABASE IF NOT EXISTS HuellitasPerdidas DEFAULT CHARACTER SET utf8mb4;
USE HuellitasPerdidas;


CREATE TABLE usuario (
  id_usuario INT AUTO_INCREMENT PRIMARY KEY,
  correo VARCHAR(100) NOT NULL UNIQUE,
  password VARCHAR(255) NOT NULL,
  nombre VARCHAR(50) NOT NULL,
  apellido VARCHAR(60),
  fechanacimiento DATE,
  id_tipodeusuario INT
);

CREATE TABLE especie (
  id_especie INT AUTO_INCREMENT PRIMARY KEY,
  nombre VARCHAR(50) NOT NULL
);

CREATE TABLE raza (
  id_raza INT AUTO_INCREMENT PRIMARY KEY,
  nombre VARCHAR(50) NOT NULL,
  id_especie INT,
  FOREIGN KEY (id_especie) REFERENCES especie(id_especie)
);

CREATE TABLE mascota (
  id_mascota INT AUTO_INCREMENT PRIMARY KEY,
  id_especie INT,
  nombredemascota VARCHAR(45),
  descripcion TEXT,
  foto TEXT,
  id_raza INT,
  fechadeextravio DATETIME,
  ubicacion TEXT,
  id_usuario INT,
  FOREIGN KEY (id_especie) REFERENCES especie(id_especie),
  FOREIGN KEY (id_raza) REFERENCES raza(id_raza),
  FOREIGN KEY (id_usuario) REFERENCES usuario(id_usuario)
);

CREATE TABLE fotodemascotas (
  id_fotodemascotas INT AUTO_INCREMENT PRIMARY KEY,
  id_mascota INT,
  url_foto TEXT,
  descripcion TEXT,
  FOREIGN KEY (id_mascota) REFERENCES mascota(id_mascota)
);

CREATE TABLE comentario (
  id_comentario INT AUTO_INCREMENT PRIMARY KEY,
  fechadelcomentario DATETIME,
  id_reporte INT,
  comentario TEXT,
  id_usuario INT,
  FOREIGN KEY (id_usuario) REFERENCES usuario(id_usuario)

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
