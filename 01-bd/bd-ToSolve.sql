CREATE DATABASE IF NOT EXISTS `bd-to-solve`;
USE `bd-to-solve`;

CREATE TABLE IF NOT EXISTS `users` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `name` varchar(50) NOT NULL,
    `email` varchar(50) NOT NULL,
    `password` varchar(100) NOT NULL,
    `create_at` timestamp NOT NULL DEFAULT current_timestamp(),
    `update_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
    PRIMARY KEY (`id`),
    UNIQUE KEY `email_UNIQUE` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `person` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `idUser` int(11) NOT NULL,
    `linguagem` VARCHAR(55) NOT NULL,
    `descricao` VARCHAR(55),
    PRIMARY KEY(`id`),
    FOREIGN KEY(`idUser`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `company` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `idUser` int(11) NOT NULL,
    PRIMARY KEY (`id`),
    FOREIGN KEY (`idUser`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `repositories` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `name` VARCHAR(50) NOT NULL,
    `linguagem` VARCHAR(50) NOT NULL,
    `descricao` VARCHAR(50) NOT NULL,
    `idCategory` int(11),
    PRIMARY KEY(`id`),
    FOREIGN KEY (`idCategory`) REFERENCES `categories` (`id`)
);

CREATE TABLE IF NOT EXISTS `categories` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `language` varchar(50) NOT NULL,
    PRIMARY KEY(`id`)
);


INSERT INTO categories (language) VALUES ("JavaScript"), ("Java"), ("Php"), ("Python");