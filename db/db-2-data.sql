-- Sélectionne la base de données à utiliser
USE `site-e-commerce-SAID`;

-- Insertion des rôles
INSERT INTO role (id, code, label) VALUES
     (10, 'A', 'Admin'),
     (20, 'P', 'Public')
;

-- Insertion des utilisateurs
INSERT INTO user (id, idRole, password, email) VALUES
     (80, 10, '$2y$10$lFxmIp/dShJEVWCCkKxwpu2e5dV88zo//4mpaYrl3UqHvpgrNdIom', 'admin@hotmail.fr'),
     (90, 20, '$2y$10$lFxmIp/dShJEVWCCkKxwpu2e5dV88zo//4mpaYrl3UqHvpgrNdIom', 'adminsecondaire@gmail.com'),
     (100, 20, '$2y$10$lFxmIp/dShJEVWCCkKxwpu2e5dV88zo//4mpaYrl3UqHvpgrNdIom', 'anthony@gmail.com'),
     (110, 20, '$2y$10$lFxmIp/dShJEVWCCkKxwpu2e5dV88zo//4mpaYrl3UqHvpgrNdIom', 'amelie@gmail.com')
;

-- Insertion des produits
INSERT INTO product (name, description, idUser) VALUES
    ("Miel d'Oranger", 'description...', 80)
;

-- Insertion du stock de produits
INSERT INTO product_stock (idProduct, poids, price, quantity) VALUES
      (1, '250g', 20, 5),
      (1, '500g', 40, 5),
      (1, '1kg', 60, 5)
;

-- Insertion des informations de commande
INSERT INTO commande_info (id, idUser, email, order_date, total, status) VALUES 
      (1, 80, 'blabla@gmail.fr', '2024-08-23 11:00:00', 19.00, 'Accepted')
;

-- Insertion des produits dans la commande
INSERT INTO commande_product (idCommande_info, idProduct, name, poids, quantity, price) VALUES 
      (1, 1, "Miel d'Oranger", '250g', 5, 20)
;

-- Insertion des avis
INSERT INTO avis (content, date, idProduct, idUser) VALUES
   ('Délicieux miaam', '2023-01-01 10:00:00', 1, 80)
;
