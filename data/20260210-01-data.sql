-- Test data for takalo database

-- Roles
INSERT INTO roles (code, libelle) VALUES ('user', 'Utilisateur');
INSERT INTO roles (code, libelle) VALUES ('admin', 'Administrateur');

-- Utilisateurs
INSERT INTO utilisateurs (nom, email, password_hash, role_id) VALUES ('Jean', 'jean@example.com', '$2y$10$cDoDpXattpZT2kp2ZqIJGuzrInR8eXPvzFF2BBRStTyzHgW.h2Ngi', 1);
INSERT INTO utilisateurs (nom, email, password_hash, role_id) VALUES ('Marie', 'marie@example.com', '$2y$10$y2ffuDIWbdKtE1kyU0662u6MC/orZyKD8T1N5W2AqPYCV.JSCGvA2', 1);
INSERT INTO utilisateurs (nom, email, password_hash, role_id) VALUES ('Pierre', 'pierre@example.com', '$2y$10$2cdDTjrYW7I8s/AzF5y3ruYo7v/TL.lwZdrChE30.e3aIV5Lx8Fbu', 1);
INSERT INTO utilisateurs (nom, email, password_hash, role_id) VALUES ('Admin', 'admin@example.com', '$2y$10$hpgcoFH.dxkymO9Qdwfp8.TcwuoRnNXZmzbon1BWjvwdksrV.7GHq', 2);

-- Categorie
INSERT INTO categories (libelle, symbole) VALUES ('Electronique', 'e');
INSERT INTO categories (libelle, symbole) VALUES ('Vetements', 'v');
INSERT INTO categories (libelle, symbole) VALUES ('Livres', 'l');
INSERT INTO categories (libelle, symbole) VALUES ('Meubles', 'm');
INSERT INTO categories (libelle, symbole) VALUES ('Sports', 's');

-- Etats objet
INSERT INTO etats_objet (code, libelle) VALUES ('neuf', 'Neuf');
INSERT INTO etats_objet (code, libelle) VALUES ('bon', 'Bon état');
INSERT INTO etats_objet (code, libelle) VALUES ('moyen', 'État moyen');
INSERT INTO etats_objet (code, libelle) VALUES ('mauvais', 'Mauvais état');

-- Statuts objet
INSERT INTO statuts_objet (code, libelle) VALUES ('disponible', 'Disponible');
INSERT INTO statuts_objet (code, libelle) VALUES ('reserve', 'Réservé');
INSERT INTO statuts_objet (code, libelle) VALUES ('vendu', 'Vendu');

-- Statuts echange
INSERT INTO statuts_echange (code, libelle) VALUES ('en_attente', 'En attente');
INSERT INTO statuts_echange (code, libelle) VALUES ('accepte', 'Accepté');
INSERT INTO statuts_echange (code, libelle) VALUES ('refuse', 'Refusé');

-- Objets (20 objets)
INSERT INTO objets (proprietaire_id, categorie_id, etat_id, statut_id, titre, description, prix_estime) VALUES (1, 1, 1, 1, 'Ordinateur portable', 'Ordinateur portable neuf', 800.00);
INSERT INTO objets (proprietaire_id, categorie_id, etat_id, statut_id, titre, description, prix_estime) VALUES (1, 2, 2, 1, 'T-shirt rouge', 'T-shirt en coton', 15.00);
INSERT INTO objets (proprietaire_id, categorie_id, etat_id, statut_id, titre, description, prix_estime) VALUES (2, 3, 1, 1, 'Livre de programmation', 'Guide complet PHP', 25.00);
INSERT INTO objets (proprietaire_id, categorie_id, etat_id, statut_id, titre, description, prix_estime) VALUES (2, 4, 3, 1, 'Chaise de bureau', 'Chaise ergonomique', 120.00);
INSERT INTO objets (proprietaire_id, categorie_id, etat_id, statut_id, titre, description, prix_estime) VALUES (3, 5, 2, 1, 'Ballon de football', 'Ballon professionnel', 30.00);
INSERT INTO objets (proprietaire_id, categorie_id, etat_id, statut_id, titre, description, prix_estime) VALUES (1, 1, 1, 1, 'Smartphone', 'Dernier modèle', 600.00);
INSERT INTO objets (proprietaire_id, categorie_id, etat_id, statut_id, titre, description, prix_estime) VALUES (2, 2, 2, 1, 'Jean bleu', 'Jean slim fit', 40.00);
INSERT INTO objets (proprietaire_id, categorie_id, etat_id, statut_id, titre, description, prix_estime) VALUES (3, 3, 1, 1, 'Roman policier', 'Thriller captivant', 12.00);
INSERT INTO objets (proprietaire_id, categorie_id, etat_id, statut_id, titre, description, prix_estime) VALUES (1, 4, 3, 1, 'Table basse', 'Table en bois', 150.00);
INSERT INTO objets (proprietaire_id, categorie_id, etat_id, statut_id, titre, description, prix_estime) VALUES (2, 5, 2, 1, 'Raquette de tennis', 'Raquette Wilson', 80.00);
INSERT INTO objets (proprietaire_id, categorie_id, etat_id, statut_id, titre, description, prix_estime) VALUES (3, 1, 1, 1, 'Casque audio', 'Casque sans fil', 100.00);
INSERT INTO objets (proprietaire_id, categorie_id, etat_id, statut_id, titre, description, prix_estime) VALUES (1, 2, 2, 1, 'Pull-over', 'Pull en laine', 35.00);
INSERT INTO objets (proprietaire_id, categorie_id, etat_id, statut_id, titre, description, prix_estime) VALUES (2, 3, 1, 1, 'Manuel de maths', 'Pour étudiants', 20.00);
INSERT INTO objets (proprietaire_id, categorie_id, etat_id, statut_id, titre, description, prix_estime) VALUES (3, 4, 3, 1, 'Armoire', 'Armoire ancienne', 200.00);
INSERT INTO objets (proprietaire_id, categorie_id, etat_id, statut_id, titre, description, prix_estime) VALUES (1, 5, 2, 1, 'Vélo', 'Vélo de course', 250.00);
INSERT INTO objets (proprietaire_id, categorie_id, etat_id, statut_id, titre, description, prix_estime) VALUES (2, 1, 1, 1, 'Tablette', 'Tablette Android', 300.00);
INSERT INTO objets (proprietaire_id, categorie_id, etat_id, statut_id, titre, description, prix_estime) VALUES (3, 2, 2, 1, 'Robe', 'Robe de printemps', 50.00);
INSERT INTO objets (proprietaire_id, categorie_id, etat_id, statut_id, titre, description, prix_estime) VALUES (1, 3, 1, 1, 'BD', 'Bande dessinée', 8.00);
INSERT INTO objets (proprietaire_id, categorie_id, etat_id, statut_id, titre, description, prix_estime) VALUES (2, 4, 3, 1, 'Lit', 'Lit double', 400.00);
INSERT INTO objets (proprietaire_id, categorie_id, etat_id, statut_id, titre, description, prix_estime) VALUES (3, 5, 2, 1, 'Skis', 'Paire de skis', 150.00);

-- Photos objets (liens vers images/products/)
INSERT INTO photos_objet (objet_id, chemin, ordre, est_principale) VALUES (1, 'images/products/ordinateur1.jpg', 1, true);
INSERT INTO photos_objet (objet_id, chemin, ordre, est_principale) VALUES (2, 'images/products/tshirt1.jpg', 1, true);
INSERT INTO photos_objet (objet_id, chemin, ordre, est_principale) VALUES (3, 'images/products/livre1.jpg', 1, true);
INSERT INTO photos_objet (objet_id, chemin, ordre, est_principale) VALUES (4, 'images/products/chaise1.jpg', 1, true);
INSERT INTO photos_objet (objet_id, chemin, ordre, est_principale) VALUES (5, 'images/products/ballon1.jpg', 1, true);
INSERT INTO photos_objet (objet_id, chemin, ordre, est_principale) VALUES (6, 'images/products/smartphone1.jpg', 1, true);
INSERT INTO photos_objet (objet_id, chemin, ordre, est_principale) VALUES (7, 'images/products/jean1.jpg', 1, true);
INSERT INTO photos_objet (objet_id, chemin, ordre, est_principale) VALUES (8, 'images/products/roman1.jpg', 1, true);
INSERT INTO photos_objet (objet_id, chemin, ordre, est_principale) VALUES (9, 'images/products/table1.jpg', 1, true);
INSERT INTO photos_objet (objet_id, chemin, ordre, est_principale) VALUES (10, 'images/products/raquette1.jpg', 1, true);
INSERT INTO photos_objet (objet_id, chemin, ordre, est_principale) VALUES (11, 'images/products/casque1.jpg', 1, true);
INSERT INTO photos_objet (objet_id, chemin, ordre, est_principale) VALUES (12, 'images/products/pullover1.jpg', 1, true);
INSERT INTO photos_objet (objet_id, chemin, ordre, est_principale) VALUES (13, 'images/products/manuel1.jpg', 1, true);
INSERT INTO photos_objet (objet_id, chemin, ordre, est_principale) VALUES (14, 'images/products/armoire1.jpg', 1, true);
INSERT INTO photos_objet (objet_id, chemin, ordre, est_principale) VALUES (15, 'images/products/velo1.jpg', 1, true);
INSERT INTO photos_objet (objet_id, chemin, ordre, est_principale) VALUES (16, 'images/products/tablette1.jpg', 1, true);
INSERT INTO photos_objet (objet_id, chemin, ordre, est_principale) VALUES (17, 'images/products/robe1.jpg', 1, true);
INSERT INTO photos_objet (objet_id, chemin, ordre, est_principale) VALUES (18, 'images/products/bd1.jpg', 1, true);
INSERT INTO photos_objet (objet_id, chemin, ordre, est_principale) VALUES (19, 'images/products/lit1.jpg', 1, true);
INSERT INTO photos_objet (objet_id, chemin, ordre, est_principale) VALUES (20, 'images/products/skis1.jpg', 1, true);

-- Echanges
INSERT INTO echanges (demandeur_id, receveur_id, statut_id) VALUES (1, 2, 1); -- Jean demande a Marie
INSERT INTO echanges (demandeur_id, receveur_id, statut_id) VALUES (3, 4, 2); -- Pierre demande a Admin, accepte

-- Echange objets
INSERT INTO echange_objets (echange_id, objet_id, direction) VALUES (1, 1, 'OFFERT'); -- Jean offre ordinateur
INSERT INTO echange_objets (echange_id, objet_id, direction) VALUES (1, 3, 'DEMANDE'); -- Jean demande livre de Marie
INSERT INTO echange_objets (echange_id, objet_id, direction) VALUES (2, 5, 'OFFERT'); -- Pierre offre ballon
INSERT INTO echange_objets (echange_id, objet_id, direction) VALUES (2, 6, 'DEMANDE'); -- Pierre demande smartphone de Jean (mais echange avec admin, wait, adjust)
-- Correction: pour echange 2, objets de Pierre et Admin
INSERT INTO echange_objets (echange_id, objet_id, direction) VALUES (2, 5, 'OFFERT'); -- Pierre offre ballon
INSERT INTO echange_objets (echange_id, objet_id, direction) VALUES (2, 11, 'DEMANDE'); -- Pierre demande casque de Admin (objet 11 is Admin's)