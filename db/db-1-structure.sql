-- - Supprime la base de données si elle existe déjà
-- - Crée la base de données
-- - Mentionne le nom de la base de données à utiliser pour exécuter les commandes SQL qui suivent
DROP DATABASE IF EXISTS `site-e-commerce-examen-SAID`;
CREATE DATABASE IF NOT EXISTS `site-e-commerce-examen-SAID`;
USE `site-e-commerce-examen-SAID`;
-- -------------
-- TABLES
-- -------------
CREATE TABLE role (
    id INT PRIMARY KEY AUTO_INCREMENT
    ,code VARCHAR(250) NOT NULL
    ,label VARCHAR(100) NOT NULL
);


CREATE TABLE user (
    id INT PRIMARY KEY AUTO_INCREMENT
    ,password VARCHAR(100) NOT NULL
    ,email VARCHAR(100) NOT NULL
    ,idRole INT
    ,photo longblob
    ,photo_filename varchar(255)
);

CREATE TABLE product (
     id INT AUTO_INCREMENT PRIMARY KEY
     ,name VARCHAR(250)
     ,description TEXT
    ,idUser INT
    ,photo longblob
    ,photo_filename varchar(255)
);

-- Création de la table options_products
CREATE TABLE product_stock (
    id INT AUTO_INCREMENT PRIMARY KEY
    ,poids VARCHAR(50) NOT NULL
    ,price DECIMAL(10, 2) NOT NULL
    ,quantity INT NOT NULL
    ,idProduct INT NOT NULL
);

CREATE TABLE cart_product (
    id INT AUTO_INCREMENT PRIMARY KEY
    ,idUser INT NOT NULL
    ,idProduct INT NOT NULL
    ,poids VARCHAR(50) NOT NULL
    ,quantity INT NOT NULL
    ,date_added TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    ,sessionId INT NOT NULL
);

CREATE TABLE commande_info (
    id INT AUTO_INCREMENT PRIMARY KEY
    ,idUser INT NOT NULL
    ,email VARCHAR(100) NOT NULL
    ,order_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    ,total DECIMAL(10, 2) NOT NULL
    ,status VARCHAR(50) DEFAULT 'Pending'
);

CREATE TABLE commande_product (
    id INT AUTO_INCREMENT PRIMARY KEY
    ,idCommande_info INT NOT NULL
    ,idProduct INT NOT NULL
    ,name VARCHAR(250)
    ,poids VARCHAR(50) NOT NULL
    ,quantity INT NOT NULL
   ,price DECIMAL(10, 2) NOT NULL
);


CREATE TABLE avis (
    id INT AUTO_INCREMENT PRIMARY KEY
    ,content TEXT NOT NULL
    ,date DATETIME NOT NULL
    ,idProduct INT NOT NULL
    ,idUser INT NOT NULL
);

ALTER TABLE role
   ADD CONSTRAINT `u_role_code` UNIQUE(code)
   ,ADD CONSTRAINT `u_role_label` UNIQUE(label)
;

ALTER TABLE user
   ADD CONSTRAINT `u_user_email` UNIQUE(email)
   ,ADD CONSTRAINT `fk_user_role` FOREIGN KEY(idRole) REFERENCES role(id)
;

ALTER TABLE product
   ADD CONSTRAINT `fk_product_user` FOREIGN KEY(idUser) REFERENCES user(id)
;

ALTER TABLE product_stock
   ADD CONSTRAINT `fk_product_stock_product` FOREIGN KEY(idProduct) REFERENCES Product(id)
;

ALTER TABLE avis
   ADD CONSTRAINT `fk_avis_product` FOREIGN KEY(idProduct) REFERENCES product(id)
   ,ADD CONSTRAINT `fk_avis_user` FOREIGN KEY(idUser) REFERENCES user(id)
;

ALTER TABLE cart_product
   ADD CONSTRAINT `fk_cart_product_product` FOREIGN KEY(idProduct) REFERENCES product(id)
   ,ADD CONSTRAINT `fk_cart_product_user` FOREIGN KEY(idUser) REFERENCES user(id)
;

ALTER TABLE commande_info
   ADD CONSTRAINT `fk_commande_info_user` FOREIGN KEY(idUser) REFERENCES user(id)
;

ALTER TABLE commande_product
   ADD CONSTRAINT `fk_commande_product_product` FOREIGN KEY(idProduct) REFERENCES product(id)
   ,ADD CONSTRAINT `fk_commande_product_commande_info` FOREIGN KEY(idCommande_info) REFERENCES commande_info(id)
;



