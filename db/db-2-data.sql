-- Sélectionne la base de données à utiliser
USE `site-e-commerce-SAID`;

-- Insertion des rôles
INSERT INTO role (id, code, label) VALUES
     (10, 'A', 'Admin'),
     (20, 'P', 'Public')
;


-- Insertion des utilisateurs
INSERT INTO user (id, idRole, password, email, nom, prenom) VALUES
     (80, 10, '$2y$10$lFxmIp/dShJEVWCCkKxwpu2e5dV88zo//4mpaYrl3UqHvpgrNdIom', 'admin@hotmail.fr', 'Said', 'Soidroudine'),
     (90, 20, '$2y$10$lFxmIp/dShJEVWCCkKxwpu2e5dV88zo//4mpaYrl3UqHvpgrNdIom', 'anthony@gmail.com', 'Anthony', 'Dupont'),
     (100, 20, '$2y$10$lFxmIp/dShJEVWCCkKxwpu2e5dV88zo//4mpaYrl3UqHvpgrNdIom', 'amelie@gmail.com', 'Amélie', 'Martin')
;

