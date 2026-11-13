-- base.sql : à importer dans phpMyAdmin (onglet SQL)
CREATE DATABASE IF NOT EXISTS uadb_cours CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE uadb_cours;

-- Table 1 : filieres
CREATE TABLE IF NOT EXISTS filieres (
    id  INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(100) NOT NULL UNIQUE
) ENGINE=InnoDB;

-- Table 2 : etudiants (appartient à une filière)
CREATE TABLE IF NOT EXISTS etudiants (
    id         INT AUTO_INCREMENT PRIMARY KEY,
    nom        VARCHAR(100) NOT NULL,
    filiere_id INT NOT NULL,
    moyenne    DECIMAL(4,2) NULL CHECK (moyenne BETWEEN 0 AND 20),
    passe      VARCHAR(255) NOT NULL,
    FOREIGN KEY (filiere_id) REFERENCES filieres(id) ON DELETE RESTRICT
) ENGINE=InnoDB;

-- Table 3 : matieres (appartient à une filière)
CREATE TABLE IF NOT EXISTS matieres (
    id          INT AUTO_INCREMENT PRIMARY KEY,
    intitule    VARCHAR(100) NOT NULL,
    coefficient INT NOT NULL DEFAULT 1,
    filiere_id  INT NOT NULL,
    FOREIGN KEY (filiere_id) REFERENCES filieres(id) ON DELETE RESTRICT
) ENGINE=InnoDB;

-- Quelques données de départ
INSERT INTO filieres (nom) VALUES ('SRT'), ('Informatique'), ('Électronique');
INSERT INTO matieres (intitule, coefficient, filiere_id) VALUES
    ('Réseaux', 3, 1), ('Linux', 2, 1), ('Programmation Java', 3, 2);
