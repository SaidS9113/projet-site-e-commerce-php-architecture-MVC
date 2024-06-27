-- - Supprime la base de données si elle existe déjà
-- - Crée la base de données
-- - Mentionne le nom de la base de données à utiliser pour exécuter les commandes SQL qui suivent
DROP DATABASE IF EXISTS `ECF-SportCard-SSD`;
CREATE DATABASE IF NOT EXISTS `ECF-SportCard-SSD`;
USE `ECF-SportCard-SSD`;
-- -------------
-- TABLES
-- -------------
CREATE TABLE role (
    id INT PRIMARY KEY AUTO_INCREMENT
    ,code VARCHAR(250) NOT NULL
    ,label VARCHAR(100) NOT NULL
);

CREATE TABLE categorie (
    id INT PRIMARY KEY AUTO_INCREMENT
    ,nom VARCHAR(100) NOT NULL
);

CREATE TABLE user (
    id INT PRIMARY KEY AUTO_INCREMENT
    ,password VARCHAR(100) NOT NULL
    ,email VARCHAR(100) NOT NULL
    ,idRole INT
    ,photo longblob
    ,photo_filename varchar(255)
);

CREATE TABLE vehicule (
    id INT PRIMARY KEY AUTO_INCREMENT
    ,nom VARCHAR(100) NOT NULL
    ,marque VARCHAR(100) NOT NULL
    ,price DECIMAL(10,2) NOT NULL
    ,idCategorie INT
    ,idUser INT
    ,photo longblob
    ,photo_filename varchar(255)
);

CREATE TABLE commentaire (
    id INT PRIMARY KEY AUTO_INCREMENT
    ,contenu TEXT NOT NULL
    ,date TIMESTAMP NOT NULL
    ,idVehicule INT
    ,idUser INT
);

ALTER TABLE role
   ADD CONSTRAINT `u_role_code` UNIQUE(code)
   ,ADD CONSTRAINT `u_role_label` UNIQUE(label)
;

ALTER TABLE user
   ADD CONSTRAINT `u_user_email` UNIQUE(email)
   ,ADD CONSTRAINT `fk_user_role` FOREIGN KEY(idRole) REFERENCES role(id)
;

ALTER TABLE vehicule
   ADD CONSTRAINT `fk_vehicule_categorie` FOREIGN KEY(idCategorie) REFERENCES categorie(id)
   ,ADD CONSTRAINT `fk_vehicule_user` FOREIGN KEY(idUser) REFERENCES user(id)
;

ALTER TABLE commentaire
   ADD CONSTRAINT `fk_commentaire_vehicule` FOREIGN KEY(idVehicule) REFERENCES vehicule(id)
   ,ADD CONSTRAINT `fk_commentaire_user` FOREIGN KEY(idUser) REFERENCES user(id)
;




