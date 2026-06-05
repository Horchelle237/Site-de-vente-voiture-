-- =====================================================================
-- BASE DE DONNÉES : euro_auto
-- Projet  : Site dynamique de vente de véhicules - EuroAuto
-- Auteur  : TAMESSING PIATA HORCHELLE DOLVINE
-- BTS SIO option SLAM - Session 2026
-- SGBD    : MySQL 8 / MariaDB 10
-- =====================================================================

DROP DATABASE IF EXISTS euro_auto;
CREATE DATABASE euro_auto
    DEFAULT CHARACTER SET utf8mb4
    DEFAULT COLLATE utf8mb4_unicode_ci;
USE euro_auto;

-- =====================================================================
-- Table : categories
-- Catégorie d'un véhicule (Berline, SUV, Citadine, Sportive...)
-- =====================================================================
CREATE TABLE categories (
    id          INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    nom         VARCHAR(50) NOT NULL UNIQUE,
    description VARCHAR(255) DEFAULT NULL
) ENGINE=InnoDB;

-- =====================================================================
-- Table : vehicules
-- Véhicules mis en vente
-- =====================================================================
CREATE TABLE vehicules (
    id           INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    marque       VARCHAR(60)  NOT NULL,
    modele       VARCHAR(60)  NOT NULL,
    annee        SMALLINT UNSIGNED NOT NULL,
    prix         DECIMAL(10,2) NOT NULL,
    kilometrage  INT UNSIGNED DEFAULT 0,
    carburant    ENUM('Essence','Diesel','Hybride','Electrique','GPL') NOT NULL,
    boite        ENUM('Manuelle','Automatique') NOT NULL DEFAULT 'Manuelle',
    puissance    SMALLINT UNSIGNED DEFAULT NULL COMMENT 'Puissance en chevaux',
    couleur      VARCHAR(40)  DEFAULT NULL,
    description  TEXT NOT NULL,
    image        VARCHAR(255) NOT NULL,
    disponible   TINYINT(1) NOT NULL DEFAULT 1,
    categorie_id INT UNSIGNED NOT NULL,
    date_ajout   DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT fk_vehicule_categorie
        FOREIGN KEY (categorie_id) REFERENCES categories(id)
        ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE=InnoDB;

CREATE INDEX idx_vehicules_marque ON vehicules(marque);
CREATE INDEX idx_vehicules_dispo  ON vehicules(disponible);

-- =====================================================================
-- Table : utilisateurs
-- Comptes des utilisateurs ayant déposé un témoignage
-- =====================================================================
CREATE TABLE utilisateurs (
    id     INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    nom    VARCHAR(80) NOT NULL,
    prenom VARCHAR(80) NOT NULL,
    email  VARCHAR(150) NOT NULL UNIQUE,
    date_inscription DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

-- =====================================================================
-- Table : temoignages
-- Avis et témoignages clients
-- =====================================================================
CREATE TABLE temoignages (
    id             INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    utilisateur_id INT UNSIGNED DEFAULT NULL,
    nom_affiche    VARCHAR(100) NOT NULL,
    note           TINYINT UNSIGNED NOT NULL CHECK (note BETWEEN 1 AND 5),
    message        TEXT NOT NULL,
    valide         TINYINT(1) NOT NULL DEFAULT 0
        COMMENT 'Modération : 1 = approuvé et publié',
    date_creation  DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT fk_temoignage_user
        FOREIGN KEY (utilisateur_id) REFERENCES utilisateurs(id)
        ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB;

-- =====================================================================
-- Table : contacts
-- Messages reçus depuis le formulaire de contact
-- =====================================================================
CREATE TABLE contacts (
    id        INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    nom       VARCHAR(80)  NOT NULL,
    prenom    VARCHAR(80)  NOT NULL,
    email     VARCHAR(150) NOT NULL,
    telephone VARCHAR(20)  DEFAULT NULL,
    sujet     VARCHAR(150) DEFAULT NULL,
    message   TEXT NOT NULL,
    lu        TINYINT(1) NOT NULL DEFAULT 0,
    date_envoi DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

-- =====================================================================
-- Table : admins
-- Comptes administrateurs (back-office)
-- =====================================================================
CREATE TABLE admins (
    id              INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    login           VARCHAR(60)  NOT NULL UNIQUE,
    email           VARCHAR(150) NOT NULL UNIQUE,
    mot_de_passe    VARCHAR(255) NOT NULL COMMENT 'Hash bcrypt',
    nom_complet     VARCHAR(120) NOT NULL,
    derniere_connexion DATETIME DEFAULT NULL,
    date_creation   DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

-- =====================================================================
-- JEU DE DONNÉES DE DÉMONSTRATION
-- =====================================================================

-- Catégories ----------------------------------------------------------
INSERT INTO categories (nom, description) VALUES
('Berline',   'Voitures 4 portes spacieuses et confortables'),
('SUV',       'Véhicules tout-terrain modernes et élégants'),
('Citadine',  'Compactes idéales pour la ville'),
('Sportive',  'Voitures sportives haute performance'),
('Utilitaire','Véhicules professionnels et utilitaires');

-- Véhicules -----------------------------------------------------------
INSERT INTO vehicules
(marque, modele, annee, prix, kilometrage, carburant, boite, puissance, couleur, description, image, categorie_id) VALUES
('BMW',         'Série 5 530i',     2023,  54900.00,  18500, 'Essence',    'Automatique', 252, 'Noir Saphir',
 'Berline premium au design affirmé, équipée du Live Cockpit Professional, sièges cuir, toit ouvrant panoramique et pack M Sport.',
 'bmw-serie5.jpg', 1),

('Mercedes',    'Classe C 220d',    2022,  46500.00,  32000, 'Diesel',     'Automatique', 200, 'Gris Sélénite',
 'Élégance et raffinement avec l''écran MBUX 11.9", ambiance lumineuse 64 couleurs, conduite semi-autonome niveau 2.',
 'mercedes-classec.jpg', 1),

('Audi',        'A4 Avant 40 TDI',  2023,  42900.00,  21000, 'Diesel',     'Automatique', 204, 'Blanc Glacier',
 'Break premium, transmission quattro, virtual cockpit, jantes 19", équipement S-line complet.',
 'audi-a4.jpg', 1),

('Porsche',     'Cayenne S',        2022, 89900.00,  28000, 'Essence',    'Automatique', 440, 'Rouge Carmin',
 'SUV sportif d''exception, V6 biturbo, suspension pneumatique adaptative, intérieur cuir bicolore.',
 'porsche-cayenne.jpg', 2),

('Range Rover', 'Evoque P200',      2023,  56700.00,  15600, 'Essence',    'Automatique', 200, 'Vert Forest',
 'SUV compact luxueux, design iconique, écrans tactiles double, toit panoramique fixe, jantes 20".',
 'rangerover-evoque.jpg', 2),

('Tesla',       'Model Y Long Range',2024, 49990.00,   5400, 'Electrique', 'Automatique', 514, 'Blanc Nacré',
 'SUV électrique 100% autonome niveau 2, autonomie 533 km, accélération 0-100 en 5s, intérieur minimaliste.',
 'tesla-modely.jpg', 2),

('Peugeot',     '208 GT',           2023,  22500.00,  12300, 'Essence',    'Manuelle',    130, 'Jaune Faro',
 'Citadine sportive, i-Cockpit 3D, écran tactile 10", caméra de recul, ambiance LED.',
 'peugeot-208.jpg', 3),

('Renault',     'Clio E-Tech',      2023,  19900.00,   9800, 'Hybride',    'Automatique', 145, 'Bleu Iron',
 'Compacte hybride auto-rechargeable, consommation 4.3L/100km, écran 9.3", aides à la conduite avancées.',
 'renault-clio.jpg', 3),

('Mini',        'Cooper S',         2022,  26800.00,  24500, 'Essence',    'Manuelle',    178, 'British Racing Green',
 'Citadine sportive iconique, 3 portes, pack John Cooper Works, sièges sport cuir.',
 'mini-cooper.jpg', 3),

('Porsche',     '911 Carrera S',    2022, 139900.00,  14200, 'Essence',    'Automatique', 450, 'Argent GT',
 'Icône sportive, flat-6 biturbo, PDK 8 rapports, freins céramique, échappement sport.',
 'porsche-911.jpg', 4),

('Audi',        'RS6 Avant',        2023, 154500.00,   9800, 'Essence',    'Automatique', 600, 'Gris Daytona Mat',
 'Break ultra-performant, V8 biturbo, 0-100 en 3.6s, suspension pneumatique RS, freins céramique.',
 'audi-rs6.jpg', 4),

('Renault',     'Trafic L1H1',      2022,  28500.00,  45000, 'Diesel',     'Manuelle',    150, 'Blanc Banquise',
 'Utilitaire fiable, volume 5.8m³, attelage, climatisation, idéal artisan.',
 'renault-trafic.jpg', 5);

-- Utilisateurs --------------------------------------------------------
INSERT INTO utilisateurs (nom, prenom, email) VALUES
('Martin',  'Sophie',   'sophie.martin@example.fr'),
('Dubois',  'Antoine',  'a.dubois@example.fr'),
('Nguyen',  'Linh',     'linh.nguyen@example.fr'),
('Bernard', 'Élodie',   'elodie.bernard@example.fr'),
('Lopez',   'Jérémy',   'jeremy.lopez@example.fr');

-- Témoignages ---------------------------------------------------------
INSERT INTO temoignages (utilisateur_id, nom_affiche, note, message, valide) VALUES
(1, 'Sophie M.',  5, 'Service impeccable, l''équipe a été très à l''écoute. Mon Audi A4 est arrivée en parfait état, je recommande EuroAuto à 100% !', 1),
(2, 'Antoine D.', 5, 'Achat de ma BMW Série 5 il y a 2 mois. Accompagnement de qualité, financement clair, livraison rapide. Une équipe professionnelle.', 1),
(3, 'Linh N.',    4, 'Bonne expérience d''achat pour ma Clio E-Tech. Quelques détails administratifs à améliorer mais le véhicule est nickel.', 1),
(4, 'Élodie B.',  5, 'Mon mari et moi cherchions un SUV familial. Conseil parfait pour le Range Rover Evoque, on adore !', 1),
(5, 'Jérémy L.',  5, 'Concessionnaire sérieux, voitures soigneusement vérifiées, prix honnêtes. Je reviendrai pour ma prochaine voiture.', 1);

-- Messages de contact (exemples) -------------------------------------
INSERT INTO contacts (nom, prenom, email, telephone, sujet, message) VALUES
('Lefebvre', 'Marc',   'marc.lefebvre@example.fr', '0612345678', 'Demande d''essai', 'Bonjour, je souhaiterais essayer la Porsche Cayenne S présentée sur votre site. Êtes-vous disponibles ce samedi matin ? Cordialement.'),
('Garnier',  'Aurélie','a.garnier@example.fr',    '0698765432', 'Reprise véhicule',  'Bonjour, j''ai une Mercedes Classe E de 2018 que je souhaite reprendre pour acheter une plus récente chez vous. Quelle est votre procédure ?');

-- Compte administrateur par défaut -----------------------------------
-- Login    : admin
-- Mot de passe : Admin@2026
-- Le hash ci-dessous correspond à 'Admin@2026' (bcrypt cost 10).
INSERT INTO admins (login, email, mot_de_passe, nom_complet) VALUES
('admin', 'admin@euro-auto.fr',
 '$2y$10$bbNKp.Mz5cRjh/FeAMX82OHXCgAmTZWi/mEiksi1W575MDye68XkO',
 'Administrateur EuroAuto');

-- =====================================================================
-- FIN DU SCRIPT
-- =====================================================================
