USE `site-e-commerce-examen`;

INSERT INTO role(id, code, label ) VALUES
     (10, 'A', 'Admin')
    ,(20, 'P', 'Public')
;

INSERT INTO user(id, idRole, password, email) VALUES
     (80, 20, '$2y$10$lFxmIp/dShJEVWCCkKxwpu2e5dV88zo//4mpaYrl3UqHvpgrNdIom', 'admin@hotmail.fr.com')
    ,(90, 20, '$2y$10$lFxmIp/dShJEVWCCkKxwpu2e5dV88zo//4mpaYrl3UqHvpgrNdIom', 'adminSecondaire@gmail.com')
    ,(100, 20, '$2y$10$lFxmIp/dShJEVWCCkKxwpu2e5dV88zo//4mpaYrl3UqHvpgrNdIom', 'anthony@gmail.com')
    ,(110, 10, '$2y$10$lFxmIp/dShJEVWCCkKxwpu2e5dV88zo//4mpaYrl3UqHvpgrNdIom', 'amelie@gmail.com')
;

INSERT INTO product (image, nom_product, description) VALUES
('img1.jpg', "Miel d'Oranger d'Espagne", 'description...'),
('img2.jpg', "Miel blanc de Corse",'description...');
('img2.jpg', "Miel d'Acacia de France",'description...');
('img2.jpg', "Miel de Lavande de Corse",'description...');


INSERT INTO options_product (idProduct, option_name, price) VALUES
(1, '250g', 20.00),
(1, '500g', 40.00),
(1, '1kg', 80.00),



INSERT INTO avis (content, date_avis, idProduct, idUser) VALUES
('Délicieux miaam', '2023-01-01 10:00:00', 1, 1),
('Très bon miammmm.', '2023-01-02 12:00:00', 2, 2);
