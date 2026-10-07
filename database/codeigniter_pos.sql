-- CodeIgniter POS database export
-- Compatible with MySQL 8+ and MariaDB 10.4+.

CREATE DATABASE IF NOT EXISTS `codeigniter_pos`
    CHARACTER SET utf8mb4
    COLLATE utf8mb4_unicode_ci;

USE `codeigniter_pos`;

DROP TABLE IF EXISTS `customers`;
CREATE TABLE `customers` (
    `id` INT NOT NULL AUTO_INCREMENT,
    `full_name` VARCHAR(100) NOT NULL,
    `email` VARCHAR(100) NOT NULL,
    `phone` VARCHAR(20) NULL,
    `created_at` DATETIME NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
    `id` INT NOT NULL AUTO_INCREMENT,
    `username` VARCHAR(50) NOT NULL,
    `full_name` VARCHAR(100) NOT NULL,
    `created_at` DATETIME NOT NULL,
    PRIMARY KEY (`id`),
    UNIQUE KEY `users_username_unique` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `customers` (`id`, `full_name`, `email`, `phone`, `created_at`) VALUES
    (1, 'Alicia Reyes', 'alicia.reyes@example.com', '+63 917 555 0101', '2026-10-01 08:30:00'),
    (2, 'Marco Dela Cruz', 'marco.delacruz@example.com', '+63 917 555 0102', '2026-10-01 08:45:00'),
    (3, 'Bianca Santos', 'bianca.santos@example.com', '+63 917 555 0103', '2026-10-01 09:00:00'),
    (4, 'Noel Villanueva', 'noel.villanueva@example.com', '+63 917 555 0104', '2026-10-01 09:15:00'),
    (5, 'Trisha Mendoza', 'trisha.mendoza@example.com', '+63 917 555 0105', '2026-10-01 09:30:00');

INSERT INTO `users` (`id`, `username`, `full_name`, `created_at`) VALUES
    (1, 'mgarcia', 'Miguel Garcia', '2026-10-01 08:00:00'),
    (2, 'jtorres', 'Jasmine Torres', '2026-10-01 08:10:00'),
    (3, 'rsalazar', 'Rina Salazar', '2026-10-01 08:20:00'),
    (4, 'dlim', 'Daniel Lim', '2026-10-01 08:30:00'),
    (5, 'asoriano', 'Andrea Soriano', '2026-10-01 08:40:00');
