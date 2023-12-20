
DROP DATABASE IF EXISTS `car-rental-system`;

CREATE DATABASE `car-rental-system`;

USE `car-rental-system`;

CREATE TABLE `admin` (
    `id` INT NOT NULL AUTO_INCREMENT,
    `username` VARCHAR(50) NOT NULL,
    `role` VARCHAR(50) NOT NULL,
    `password` VARCHAR(50) NOT NULL,
    PRIMARY KEY (`id`),
    UNIQUE KEY (`username`)
);

INSERT INTO `admin` VALUES (null,'lukman','superadmin','123');
-- -----------------------------------------------------------

CREATE TABLE `users` (
    `id` INT NOT NULL AUTO_INCREMENT,
    `username` VARCHAR(50) NOT NULL,
    `email` VARCHAR(50) NOT NULL,
    `role` VARCHAR(50),
    `password` VARCHAR(50) NOT NULL,
    PRIMARY KEY (`id`),
    UNIQUE KEY (`email`),
    UNIQUE KEY (`username`)
);

CREATE TABLE `cars` (
    `id` INT NOT NULL AUTO_INCREMENT,
    `name` VARCHAR(50) NOT NULL,
    `description` VARCHAR(50) NOT NULL,
    `driver` VARCHAR(50),
    `price` DECIMAL(8,2) NOT NULL,
    `image` VARCHAR(50) NOT NULL,
    PRIMARY KEY (`id`),
    UNIQUE KEY (`name`),
    UNIQUE KEY (`image`)
);

INSERT INTO `cars` VALUES 
(null,'mercedes benz e350','comfortable car for hire','kabir sani',5000.12,'mercedes-1122334455.jfif'),
(null,'ferrari','stylish car for hire','musa isa',6000.13,'ferrari-1122334455.png'),
(null,'toyota','luxury car for hire','nuhu ahmad',4000.14,'toyota-1122334455.jfif');
-- -----------------------------------------------------------

CREATE TABLE `rentals` (
    `id` INT NOT NULL AUTO_INCREMENT,
    `user_id` INT NOT NULL,
    `car_id` INT NOT NULL,
    `price` DECIMAL(8,2),
    `rent_datetime` DATETIME NOT NULL,
    `return_datetime` DATETIME,
    `rating` VARCHAR(50) DEFAULT 'good',
    PRIMARY KEY (`id`)
);