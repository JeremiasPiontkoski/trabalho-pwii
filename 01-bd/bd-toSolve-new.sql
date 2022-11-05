CREATE DATABASE IF NOT EXISTS `bd-toSolve`;
USE `bd-toSolve`;

CREATE TABLE IF NOT EXISTS `typeUsers` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `type` varchar(50) NOT NULL,
    PRIMARY KEY(`id`)
);

INSERT INTO `typeUsers` VALUES(null, "person"), (null, "company");

CREATE TABLE IF NOT EXISTS `users` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `name` varchar(50) NOT NULL,
    `email` varchar(100) NOT NULL,
    `password` varchar(100) NOT NULL,
    `description` varchar(100) NOT NULL,
    `typeUser` int(11) NOT NULL,
    `profilePicture` varchar(255) DEFAULT NULL,
    `create_at` timestamp NOT NULL DEFAULT current_timestamp(),
    `update_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
    PRIMARY KEY (`id`),
    FOREIGN KEY(`typeUser`) REFERENCES `typeUsers` (`id`)ON DELETE NO ACTION ON UPDATE NO ACTION,
    UNIQUE KEY `email_UNIQUE` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `languages` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `language` varchar(50) NOT NULL,
    PRIMARY KEY(`id`)
);

CREATE TABLE IF NOT EXISTS `type` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `type` varchar(50) NOT NULL,
    PRIMARY KEY(`id`)
);

CREATE TABLE IF NOT EXISTS `person` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `idUser` int(11) NOT NULL,
    `cpf` VARCHAR(250) NOT NULL,
    `language` int(11) NOT NULL,
    PRIMARY KEY(`id`),
    FOREIGN KEY(`idUser`) REFERENCES `users` (`id`)ON DELETE NO ACTION ON UPDATE NO ACTION,
    FOREIGN KEY(`language`)  REFERENCES `languages` (`id`)ON DELETE NO ACTION ON UPDATE NO ACTION
)ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `company` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `idUser` int(11) NOT NULL,
    `cnpj` varchar(250) NOT NULL,
    `type` int(11) NOT NULL,
    PRIMARY KEY(`id`),
    FOREIGN KEY(`idUser`) REFERENCES `users` (`id`)ON DELETE NO ACTION ON UPDATE NO ACTION,
    FOREIGN KEY(`type`) REFERENCES `type` (`id`)ON DELETE NO ACTION ON UPDATE NO ACTION
)ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `repositories` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `name`  VARCHAR(100) NOT NULL,
    `language` VARCHAR(100) NOT NULL,
    `description` VARCHAR(250) NOT NULL,
    `idLanguage` int(11) NOT NULL,
    PRIMARY KEY(`id`),
    FOREIGN KEY(`idLanguage`) REFERENCES `languages` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
)ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

INSERT INTO languages (language) VALUES ("JavaScript"), ("Java"), ("Php"), ("Python");

INSERT INTO type (type) VALUES ("Criação de software"), ("Programação Web"), ("Programação Mobile");

INSERT INTO repositories (id, name, language, description, idLanguage) VALUES (null, "Repositorio teste", "Java", "Descricao teste", 2);