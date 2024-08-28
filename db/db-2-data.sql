USE `site-e-commerce-examen-SAID`;

INSERT INTO role (id, code, label ) VALUES
     (10, 'A', 'Admin')
    ,(20, 'P', 'Public')
;

INSERT INTO user (id, idRole, password, email) VALUES
     (80, 10, '$2y$10$lFxmIp/dShJEVWCCkKxwpu2e5dV88zo//4mpaYrl3UqHvpgrNdIom', 'admin@hotmail.fr.com')
    ,(90, 20, '$2y$10$lFxmIp/dShJEVWCCkKxwpu2e5dV88zo//4mpaYrl3UqHvpgrNdIom', 'adminsecondaire@gmail.com')
    ,(100, 20, '$2y$10$lFxmIp/dShJEVWCCkKxwpu2e5dV88zo//4mpaYrl3UqHvpgrNdIom', 'anthony@gmail.com')
    ,(110, 20, '$2y$10$lFxmIp/dShJEVWCCkKxwpu2e5dV88zo//4mpaYrl3UqHvpgrNdIom', 'amelie@gmail.com')
;

INSERT INTO product (name, description, idUser) VALUES
    ("Miel d'Oranger", 'description...',80)
;



INSERT INTO product_stock (idProduct, poids, price, quantity) VALUES
      (1, '250g', 20, 5)
      ,(1, '500g', 40, 5)
      ,(1, '1kg', 60, 5)
;

INSERT INTO cart_product (idUser, idProduct, poids, quantity, date_added, sessionId)
VALUES 
      (80, 1, 1, '250g', '2024-08-23 10:05:00', 1)
;

INSERT INTO commande_info (id, idUser, order_date, total, status)
VALUES 
      (1, 80, '2024-08-23 11:00:00', 19.00, 'Pending')
;

INSERT INTO commande_product (idCommande_info, idProduct, poids, quantity, price)
VALUES 
      (1, 1, '250g', 5, 20)
;



INSERT INTO avis (content, date, idProduct, idUser) VALUES
   ('Délicieux miaam', '2023-01-01 10:00:00', 1, 80)
;
