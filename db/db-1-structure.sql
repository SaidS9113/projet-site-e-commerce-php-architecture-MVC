
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
    id INT AUTO_INCREMENT PRIMARY KEY,
    image VARCHAR(50),
    name VARCHAR(250),
    description TEXT,
);

-- Création de la table options_products
CREATE TABLE product_option (
    id INT AUTO_INCREMENT PRIMARY KEY,
    idProduct INT NOT NULL,
    quantity VARCHAR(255) NOT NULL,
    price DECIMAL(10, 2) NOT NULL
);

CREATE TABLE avis (
    id INT AUTO_INCREMENT PRIMARY KEY,
    content TEXT NOT NULL,
    date DATETIME NOT NULL,
    idProduct INT NOT NULL,
    idUser INT NOT NULL
);



ALTER TABLE role
   ADD CONSTRAINT `u_role_code` UNIQUE(code)
   ,ADD CONSTRAINT `u_role_label` UNIQUE(label)
;

ALTER TABLE user
   ADD CONSTRAINT `u_user_email` UNIQUE(email)
   ,ADD CONSTRAINT `fk_user_role` FOREIGN KEY(idRole) REFERENCES role(id)
;

ALTER TABLE product_option
   ADD CONSTRAINT `fk_product_option_product` FOREIGN KEY(idProduct) REFERENCES Product(id)
   ,ADD CONSTRAINT `fk_product_user` FOREIGN KEY(idUser) REFERENCES user(id)
;

ALTER TABLE avis
   ADD CONSTRAINT `fk_avis_product` FOREIGN KEY(idProduct) REFERENCES product(id)
   ,ADD CONSTRAINT `fk_avis_user` FOREIGN KEY(idUser) REFERENCES user(id)
;





