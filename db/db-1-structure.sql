-- Supprime la base de données si elle existe déjà
DROP DATABASE IF EXISTS `site-e-commerce-SAID`;

-- Crée la base de données
CREATE DATABASE IF NOT EXISTS `site-e-commerce-SAID`;

-- Mentionne le nom de la base de données à utiliser
USE `site-e-commerce-SAID`;

-- -------------
-- TABLES
-- -------------

-- Table des rôles
CREATE TABLE role (
    id INT PRIMARY KEY AUTO_INCREMENT,
    code VARCHAR(250) NOT NULL,
    label VARCHAR(100) NOT NULL
);
-- Table des utilisateurs
CREATE TABLE user (
    id INT PRIMARY KEY AUTO_INCREMENT,
    password VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    idRole INT,
    photo LONGBLOB,
    photo_filename VARCHAR(255),
    nom VARCHAR(50) NOT NULL, 
    prenom VARCHAR(50) NOT NULL,
    adresse VARCHAR(255),
    code_postal VARCHAR(10)
);
-- Table des produits
CREATE TABLE product (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(250),
    description TEXT,
    idUser INT,
    photo longblob,
    photo_filename varchar(255)
);
-- Table de gestion du stock de produits
CREATE TABLE product_stock (
    id INT AUTO_INCREMENT PRIMARY KEY,
    poids VARCHAR(50) NOT NULL,
    price DECIMAL(10, 2) NOT NULL,
    quantity INT NOT NULL,
    idProduct INT NOT NULL
);

-- Table du panier (pour les utilisateurs connectés et non connectés)
CREATE TABLE cart_product (
    id INT AUTO_INCREMENT PRIMARY KEY,
    idUser INT NULL,  
    sessionId VARCHAR(255) NULL,  
    idProduct INT NOT NULL,
    poids VARCHAR(50) NOT NULL,
    quantity INT NOT NULL,
    date_added TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Table des informations de commande (modifiée pour inclure sessionId)
CREATE TABLE commande_info (
    id INT AUTO_INCREMENT PRIMARY KEY,
    idUser INT NULL, 
    sessionId VARCHAR(255) NULL,  
    email VARCHAR(100) NOT NULL,
    order_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    total DECIMAL(10, 2) NOT NULL,
    status VARCHAR(50) DEFAULT 'Pending'
);
-- Table des produits dans les commandes
CREATE TABLE commande_product (
    id INT AUTO_INCREMENT PRIMARY KEY,
    idCommande_info INT NOT NULL,
    idProduct INT NOT NULL,
    name VARCHAR(250),
    poids VARCHAR(50) NOT NULL,
    quantity INT NOT NULL,
    price DECIMAL(10, 2) NOT NULL
);
-- Table des avis produits
CREATE TABLE avis (
    id INT AUTO_INCREMENT PRIMARY KEY,
    content TEXT NOT NULL,
    date DATETIME NOT NULL,
    idProduct INT NOT NULL,
    idUser INT NOT NULL
);

-- -------------
-- CONTRAINTES
-- -------------

-- Contraintes sur la table 'role'
ALTER TABLE role
    ADD CONSTRAINT `u_role_code` UNIQUE(code),
    ADD CONSTRAINT `u_role_label` UNIQUE(label);

-- Contraintes sur la table 'user'
ALTER TABLE user
    ADD CONSTRAINT `u_user_email` UNIQUE(email),
    ADD CONSTRAINT `fk_user_role` FOREIGN KEY(idRole) REFERENCES role(id);

-- Contraintes sur la table 'product'
ALTER TABLE product
    ADD CONSTRAINT `fk_product_user` FOREIGN KEY(idUser) REFERENCES user(id);

-- Contraintes sur la table 'product_stock'
ALTER TABLE product_stock
    ADD CONSTRAINT `fk_product_stock_product` FOREIGN KEY(idProduct) REFERENCES product(id);
    
-- Contraintes sur la table 'avis'
ALTER TABLE avis
    ADD CONSTRAINT `fk_avis_product` FOREIGN KEY(idProduct) REFERENCES product(id) ON DELETE CASCADE,
    ADD CONSTRAINT `fk_avis_user` FOREIGN KEY(idUser) REFERENCES user(id) ON DELETE CASCADE;

-- Contraintes sur la table 'cart_product'
ALTER TABLE cart_product
    ADD CONSTRAINT `fk_cart_product_product` FOREIGN KEY(idProduct) REFERENCES product(id);

-- Contraintes sur la table 'commande_info'
ALTER TABLE commande_info
    ADD CONSTRAINT `fk_commande_info_user` FOREIGN KEY(idUser) REFERENCES user(id);

-- Contraintes sur la table 'commande_product'
ALTER TABLE commande_product
    ADD CONSTRAINT `fk_commande_product_product` FOREIGN KEY(idProduct) REFERENCES product(id),
    ADD CONSTRAINT `fk_commande_product_commande_info` FOREIGN KEY(idCommande_info) REFERENCES commande_info(id);
