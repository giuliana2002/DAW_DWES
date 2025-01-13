CREATE DATABASE IF NOT EXISTS lol CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE lol;

CREATE TABLE IF NOT EXISTS campeon (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(255) NOT NULL,
    rol VARCHAR(100) NOT NULL,
    dificultad ENUM('Baja', 'Media', 'Alta') NOT NULL,
    descripcion TEXT
);


INSERT INTO campeon (nombre, rol, dificultad, descripcion) VALUES
('Ahri', 'Mago', 'Media', 'Ahri es un zorro de nueve colas que encanta a sus enemigos.'),
('Jinx', 'Tirador', 'Alta', 'Jinx es una criminal loca que disfruta el caos y la destrucción.'),
('Garen', 'Tanque', 'Baja', 'Garen es un guerrero valiente y noble que lucha por la justicia.');
