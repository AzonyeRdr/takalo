-- Active: 1741104595338@@127.0.0.1@3306@ecommerce
CREATE DATABASE ecommerce;
USE ecommerce;

CREATE or replace table categorie(
    id_categorie INT PRIMARY KEY AUTO_INCREMENT,
    nom_categorie VARCHAR (50) NOT NULL
);

INSERT into categorie (nom_categorie) VALUES
("men"),
("women"),
("kids");


SELECT * FROM categorie;

drop TABLE produit;
create table produit(
    id_produit INT PRIMARY KEY AUTO_INCREMENT,
    nom_produit VARCHAR(100) NOT NULL,
    description_produit TEXT,
    prix_produit DECIMAL(10,2) NOT NULL,
    image_produit VARCHAR(255),
    id_categorie INT,
    FOREIGN KEY (id_categorie) REFERENCES categorie(id_categorie)
);

SELECT * FROM produit;

INSERT into produit (nom_produit, description_produit, prix_produit, image_produit, id_categorie) VALUES
("Men's T-Shirt", "A comfortable cotton t-shirt for men.", 19.99, "men-01.jpg", 1),
("Air Force", "Classic Nike Air Force sneakers.", 89.99, "men-02.jpg", 1),
("Love Nana ", "love nana shoes for men", 59.99, "men-03.jpg", 1),
("Men's T-Shirt", "A comfortable cotton t-shirt for women.", 19.99, "women-01.jpg", 2),
("Air Force", "Classic Nike Air Force sneakers.", 89.99, "women-02.jpg", 2),
("Love Nana ", "love nana shoes for women", 59.99, "women-03.jpg", 2),
("Men's T-Shirt", "A comfortable cotton t-shirt for kids.", 19.99, "kid-01.jpg", 3),
("Air Force", "Classic Nike Air Force sneakers.", 89.99, "kid-02.jpg", 3),
("Love Nana ", "love nana shoes for kid", 59.99, "kid-03.jpg", 3);


create or replace table images(
    id_image INT PRIMARY KEY AUTO_INCREMENT,
    url_image VARCHAR(255) NOT NULL,
    id_produit INT,
    FOREIGN KEY (id_produit) REFERENCES produit(id_produit)
);

SELECT * from images;

