
CREATE DATABASE IF NOT EXISTS snpa_db DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE snpa_db;

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(100),
    prenom VARCHAR(100),
    email VARCHAR(100) UNIQUE,
    mot_de_passe VARCHAR(100),
    role ENUM('admin', 'employe') NOT NULL
);

INSERT INTO users (nom, prenom, email, mot_de_passe, role) VALUES
('Admin', 'Principal', 'admin@snpa.tn', 'admin123', 'admin'),
('Employe', 'Test', 'employe@snpa.tn', 'employe123', 'employe');

CREATE TABLE clients (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(100),
    prenom VARCHAR(100),
    code_client VARCHAR(50),
    adresse VARCHAR(255),
    code_tva VARCHAR(50)
);

INSERT INTO clients (nom, prenom, code_client, adresse, code_tva) VALUES
('Client', 'Test', 'CL001', 'Kasserine', 'TVA123456');

CREATE TABLE articles (
    id INT AUTO_INCREMENT PRIMARY KEY,
    designation VARCHAR(255),
    code_article VARCHAR(50),
    qualite VARCHAR(50),
    couleur VARCHAR(50),
    grammage VARCHAR(50),
    format VARCHAR(50),
    prix_unitaire DECIMAL(10,2)
);

INSERT INTO articles (designation, code_article, qualite, couleur, grammage, format, prix_unitaire) VALUES
('Film Plastique', 'A001', 'Standard', 'Blanc', '50g', '1x500', 120.00);

CREATE TABLE bon_livraison (
    id INT AUTO_INCREMENT PRIMARY KEY,
    numero_bon VARCHAR(100),
    lieu VARCHAR(100),
    date_bon DATE,
    mode_paiement VARCHAR(100),
    mode_transport VARCHAR(100),
    client_id INT,
    FOREIGN KEY (client_id) REFERENCES clients(id)
);

CREATE TABLE bon_livraison_detail (
    id INT AUTO_INCREMENT PRIMARY KEY,
    bon_livraison_id INT,
    article_id INT,
    nombre_bobines INT,
    tonnage DECIMAL(10,2),
    FOREIGN KEY (bon_livraison_id) REFERENCES bon_livraison(id),
    FOREIGN KEY (article_id) REFERENCES articles(id)
);

CREATE TABLE facture (
    id INT AUTO_INCREMENT PRIMARY KEY,
    bon_livraison_id INT,
    nom_prenom VARCHAR(200),
    matricule_fiscale VARCHAR(100),
    date_facture DATE,
    lieu VARCHAR(100),
    total_ht DECIMAL(10,2),
    total_tva DECIMAL(10,2),
    total_ttc DECIMAL(10,2),
    FOREIGN KEY (bon_livraison_id) REFERENCES bon_livraison(id)
);

CREATE TABLE facture_detail (
    id INT AUTO_INCREMENT PRIMARY KEY,
    facture_id INT,
    designation VARCHAR(255),
    quantite INT,
    prix_unitaire_ht DECIMAL(10,2),
    montant_ht DECIMAL(10,2),
    taux_tva DECIMAL(5,2),
    montant_tva DECIMAL(10,2),
    FOREIGN KEY (facture_id) REFERENCES facture(id)
);
