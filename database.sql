-- Création de la base de données ainsi que les tables 

CREATE DATABASE ludotheque;


CREATE TABLE consoles (
    id SERIAL PRIMARY KEY,
    nom VARCHAR(50) NOT NULL UNIQUE,
);

CREATE TABLE jeux (
    id SERIAL PRIMARY KEY,
    titre VARCHAR(100) NOT NULL, 
    prix INT,
    complet BOOLEAN DEFAULT FALSE,
    image_path VARCHAR(255) DEFAULT 'default.jpg',
    console_id INT REFERENCES consoles(id),
    
);

