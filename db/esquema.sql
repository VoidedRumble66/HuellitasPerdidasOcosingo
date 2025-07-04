-- Esquema básico para Huellitas Perdidas
CREATE TABLE usuarios (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nombre VARCHAR(100) NOT NULL,
  email VARCHAR(100) NOT NULL UNIQUE,
  password VARCHAR(255) NOT NULL
);

CREATE TABLE mascota (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nombredemascota VARCHAR(100) DEFAULT '',
  descripcion TEXT,
  ubicacion VARCHAR(255) DEFAULT '',
  fechadeextravio DATE,
  foto TEXT,
  id_usuario INT,
  FOREIGN KEY (id_usuario) REFERENCES usuarios(id)
);

