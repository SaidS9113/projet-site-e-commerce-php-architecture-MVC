USE `ECF-SportCard-SSD`;

INSERT INTO role(id, code, label ) VALUES
     (10, 'A', 'Admin')
    ,(20, 'P', 'Public')
;

INSERT INTO user(id, idRole, password, email) VALUES
     (80, 20, '$2y$10$lFxmIp/dShJEVWCCkKxwpu2e5dV88zo//4mpaYrl3UqHvpgrNdIom', 'test1@gmail.com')
    ,(90, 20, '$2y$10$lFxmIp/dShJEVWCCkKxwpu2e5dV88zo//4mpaYrl3UqHvpgrNdIom', 'test2@gmail.com')
    ,(100, 20, '$2y$10$lFxmIp/dShJEVWCCkKxwpu2e5dV88zo//4mpaYrl3UqHvpgrNdIom', 'test3@gmail.com')
    ,(110, 10, '$2y$10$lFxmIp/dShJEVWCCkKxwpu2e5dV88zo//4mpaYrl3UqHvpgrNdIom', 'said')
;

INSERT INTO categorie(nom) VALUES
    ('Sportive')
   ,('SUV')
   ,('Break')
;

INSERT INTO vehicule(nom, marque, price, idCategorie, idUser) VALUES
   (' McLaren Artura Spider', 'McLaren', 248800.00, 1, 80)
   ,(' Tesla Model X Plaid', 'Tesla', 114990.00, 2, 90)
   ,('Porsche Taycan Turbo S', 'Porche', 216197.00, 3, 100)
;     

INSERT INTO commentaire (contenu, date, idVehicule, idUser) VALUES
   ('Super!','2024-06-20 10:00', 1, 90)
   ,('Incroyable','2024-06-20 11:00', 2, 100)
   ,('Confortable','2024-06-20 12:00', 3, 80)
;  
