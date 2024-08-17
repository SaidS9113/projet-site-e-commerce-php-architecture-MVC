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
;


DELIMITER $$

CREATE PROCEDURE add_product_options(
    IN p_idProduct INT,
    IN p_price_250g DECIMAL(10, 2),
    IN p_price_500g DECIMAL(10, 2),
    IN p_price_1kg DECIMAL(10, 2)
)
BEGIN
    -- Déclaration des variables pour stocker les conditions
    DECLARE v_quantity VARCHAR(10);

    -- Insertion conditionnelle pour 250g
    IF p_price_250g IS NOT NULL AND p_price_250g > 0 THEN
        SET v_quantity = '250g';
        INSERT INTO product_option (idProduct, quantity, price) 
        VALUES (p_idProduct, v_quantity, p_price_250g);
    END IF;

    -- Insertion conditionnelle pour 500g
    IF p_price_500g IS NOT NULL AND p_price_500g > 0 THEN
        SET v_quantity = '500g';
        INSERT INTO product_option (idProduct, quantity, price) 
        VALUES (p_idProduct, v_quantity, p_price_500g);
    END IF;

    -- Insertion conditionnelle pour 1kg
    IF p_price_1kg IS NOT NULL AND p_price_1kg > 0 THEN
        SET v_quantity = '1kg';
        INSERT INTO product_option (idProduct, quantity, price) 
        VALUES (p_idProduct, v_quantity, p_price_1kg);
    END IF;
END$$

DELIMITER ;



INSERT INTO avis (content, date, idProduct, idUser) VALUES
   ('Délicieux miaam', '2023-01-01 10:00:00', 1, 80)
;
