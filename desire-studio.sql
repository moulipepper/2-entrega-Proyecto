CREATE DATABASE IF NOT EXISTS `desire_studio`;
USE `desire_studio`;

-- Tabla de usuarios
CREATE TABLE IF NOT EXISTS `usuarios` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `nombre` VARCHAR(100) NOT NULL,
    `email` VARCHAR(100) NOT NULL UNIQUE,
    `password` VARCHAR(255) NOT NULL,
    `telefono` VARCHAR(15),
    `fecha_registro` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Tabla de servicios
CREATE TABLE IF NOT EXISTS `servicios` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `tipo_servicio` VARCHAR(100) NOT NULL,
    `descripcion` TEXT,
    `precio` DECIMAL(10,2) NOT NULL
);

-- Tabla de citas
CREATE TABLE IF NOT EXISTS `citas` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `usuario_id` INT NOT NULL,
    `servicio_id` INT NOT NULL,
    `fecha_cita` DATETIME NOT NULL,
    `estado` ENUM('Confirmada', 'Modificada', 'Cancelada') DEFAULT 'Confirmada',
    `fecha_registro` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (`usuario_id`) REFERENCES `usuarios`(`id`) ON DELETE CASCADE,
    FOREIGN KEY (`servicio_id`) REFERENCES `servicios`(`id`) ON DELETE CASCADE
);

-- Tabla de administración
CREATE TABLE IF NOT EXISTS `administradores` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `nombre` VARCHAR(100) NOT NULL,
    `email` VARCHAR(100) NOT NULL UNIQUE,
    `password` VARCHAR(255) NOT NULL,
    `fecha_registro` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Tabla de sistema de penalizaciones
CREATE TABLE IF NOT EXISTS `penalizaciones` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `usuario_id` INT NOT NULL,
    `motivo` TEXT NOT NULL,
    `fecha_penalizacion` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (`usuario_id`) REFERENCES `usuarios`(`id`) ON DELETE CASCADE
);

-- Tabla de recuperación de contraseñas
CREATE TABLE IF NOT EXISTS `password_reset` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `user_id` INT NOT NULL,
    `token` VARCHAR(255) NOT NULL,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (`user_id`) REFERENCES `usuarios`(`id`) ON DELETE CASCADE
);

-- Tabla de historial de actividades
CREATE TABLE IF NOT EXISTS `historial` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `usuario_id` INT,
    `accion` TEXT NOT NULL,
    `fecha` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (`usuario_id`) REFERENCES `usuarios`(`id`) ON DELETE SET NULL
);

-- Tabla de calendario de citas
CREATE TABLE IF NOT EXISTS `calendario_citas` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `cita_id` INT NOT NULL,
    `evento` VARCHAR(255) NOT NULL,
    `fecha_evento` DATETIME NOT NULL,
    FOREIGN KEY (`cita_id`) REFERENCES `citas`(`id`) ON DELETE CASCADE
);
