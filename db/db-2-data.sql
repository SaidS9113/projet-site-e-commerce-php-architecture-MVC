USE `site-e-commerce-examen-SAID`;

INSERT INTO role(id, code, label ) VALUES
     (10, 'A', 'Admin')
    ,(20, 'P', 'Public')
;

INSERT INTO user(id, idRole, password, email) VALUES
     (80, 10, '$2y$10$lFxmIp/dShJEVWCCkKxwpu2e5dV88zo//4mpaYrl3UqHvpgrNdIom', 'admin@hotmail.fr.com')
    ,(90, 20, '$2y$10$lFxmIp/dShJEVWCCkKxwpu2e5dV88zo//4mpaYrl3UqHvpgrNdIom', 'adminsecondaire@gmail.com')
    ,(100, 20, '$2y$10$lFxmIp/dShJEVWCCkKxwpu2e5dV88zo//4mpaYrl3UqHvpgrNdIom', 'anthony@gmail.com')
    ,(110, 20, '$2y$10$lFxmIp/dShJEVWCCkKxwpu2e5dV88zo//4mpaYrl3UqHvpgrNdIom', 'amelie@gmail.com')
;

INSERT INTO product (name, description, idUser) VALUES
    ("Miel d'Oranger", 'description...',80)
   ,("Miel blanc de Corse",'description...',90)
   ,("Miel d'Acacia de France",'description...',100)
   ,("Miel de Lavande de Corse",'description...',110)
;


INSERT INTO product_option (idProduct, quantity, price) VALUES
   (1, '250g', 20.00)
   ,(1, '500g', 40.00)
   ,(1, '1kg', 80.00)
;
INSERT INTO avis (content, date, idProduct, idUser) VALUES
   ('Délicieux miaam', '2023-01-01 10:00:00', 1, 80)
   ,('Très bon miammmm.', '2023-01-02 12:00:00', 2, 90)
;
